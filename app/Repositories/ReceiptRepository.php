<?php
namespace App\Repositories;
use App\Models\Receipt;
use App\Models\Company;
use App\Models\ReceiptItem;
use App\Models\ReceiptPayment;
use App\Models\PaymentMode;
use App\Library\Utility;

class ReceiptRepository
{
    function __construct() {

    }    

    public function getReceiptNum()
    {
        $receiptNumber = 1;
        $lastReceipt = Receipt::orderBy('id', 'desc')->first();
        $companyData = Company::first();

        if(!empty($lastReceipt))
        {
            if($lastReceipt->rec_number < $companyData->starting_receipt_num)
                $receiptNumber = $companyData->starting_receipt_num;
            else
                $receiptNumber = $lastReceipt->rec_number + 1;
        }
        else
        {
            if(!empty($companyData))
                $receiptNumber = $companyData->starting_receipt_num;
            else
                $receiptNumber = 1;                
        }


        return $receiptNumber;
    }

    public function save($data)
    {
        $totalAmount = 0;
        $receiptNumber = $this->getReceiptNum();

        $receiptRec = new Receipt();
        $receiptRec->rec_number = $receiptNumber;
        $receiptRec->contact_id = $data['contact_id'];
        $receiptRec->replaced_by_rec_id = 0;
        $receiptRec->rec_date = date('Y-m-d', strtotime($data['receipt_date']));
        $receiptRec->rec_amount = 0;
        $receiptRec->from_name = $data['receipt_name'];
        $receiptRec->rec_notes = $data['notes'];
        $receiptRec->created_by = \Session::get('user')['id'];
        $receiptRec->updated_by = 0;
        $receiptRec->deleted_at = '0000:00:00';
        $receiptRec->deleted = 0;
        $receiptRec->save();
        $receiptId = $receiptRec->id;

        if(!empty($data['item_name']))
        {
            foreach ($data['item_name'] as $key => $item) 
            {
                $itemDesc = $data['item_description'][$key];
                $itemAmount = (int) $data['item_amount'][$key];
                $totalAmount += $itemAmount;
                $itemRec = new ReceiptItem();
                $itemRec->receipt_id = $receiptId;
                $itemRec->category_item_id = $item['id'];
                $itemRec->category = '';
                $itemRec->notes = $itemDesc;
                $itemRec->item = $item['cat'];
                $itemRec->amount = $itemAmount;
                $itemRec->save();
            }
        }

        // Update amount 
        $receiptRec->rec_amount = $totalAmount;
        $receiptRec->update();

        if(!empty($data['payment_amount']))
        {
            foreach ($data['payment_amount'] as $key => $paymentMode) {
                $paymentRec = new ReceiptPayment();
                $paymentRec->receipt_id = $receiptId;
                $paymentRec->payment_mode_id = $paymentMode['payment_mode_id'];
                $paymentRec->payment_ref = $paymentMode['payment_mode_ref'];
                $paymentRec->payment_amount = $paymentMode['amount'];
                $paymentRec->save();
            }
        }

        return true;


    }


    public function destroy($id)
    {
        $rec = Receipt::find($id);
        if(!empty($rec))
        {
            $rec->deleted = 1;
            $rec->deleted_at = date('Y-m-d H:i:s');
            $rec->update();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update($data)
    {
        $rec = Module::find($data['id']);
        $rec->module = $data['module'];
        $rec->status =  $data['module_status'];
    
        if($rec->update())
        {
            return $rec->id;
        }
        else
        {
            return false;
        }
    }

    public function all($page, $limit)
    {
        $response = array('data' => array(), 'paginator' => '');
        if(!empty($limit))
        {
            $records = Receipt::where('deleted', 0)->paginate($limit);
        }
        else
        {
            $records = Receipt::where('deleted', 0)->get();
        }

        if(!empty($records))
        {
            foreach ($records as $key => $record) 
            {
                $response['data'][] = $this->get($record->id, false);
            }
        }

        if(!empty($limit))
            $response = Utility::paginator($response, $records, $limit);

        return $response;
    }



    public function getByCol($col, $val, $operand = '=')
    {
        $rec = Receipt::where($col, $operand, $val)->first();
        if(!empty($rec))
        {
            $rec = $this->get($rec->id, false);
        }

        return $rec;
    }

    public function getReceiptPaymentModes($receiptId)
    {
        $paymentModes = array();
        $receiptPaymentModes = ReceiptPayment::where('receipt_id', $receiptId)->get()->toArray();
        if(!empty($receiptPaymentModes))
        {
            foreach ($receiptPaymentModes as $key => &$receiptPaymentMode) {
                $paymentModeData = PaymentMode::find($receiptPaymentMode['payment_mode_id']);
                if(!empty($paymentModeData))
                {
                    $receiptPaymentMode['payment_mode'] = $paymentModeData->code;
                }
            }
        }

        return $receiptPaymentModes;
    }

    public function getReceiptItems($receiptId)
    {
        $items = array();
        $catItems = ReceiptItem::where('receipt_id', $receiptId)->get();
        if(!empty($catItems))
        {
            foreach ($catItems as $key => $catItem) {
                $items[] = $catItem;
            }
        }
        return $items;
    }


    public function get($id, $eleq)
    {
        $ContactRepository = new ContactRepository();
        $id = (int) $id;
        if($eleq)
        {
            $rec = Receipt::find($id);
        }
        else
        {
            $rec = Receipt::find($id)->toArray();
            $contactData = $ContactRepository->get($rec['contact_id'], true);
            if(!empty($contactData))
                $rec['contact_name'] = $contactData->name;

            // Get receipt Items
            $rec['cat_items'] = $this->getReceiptItems($id);

            $rec['payment_modes'] = $this->getReceiptPaymentModes($id);


        }
        return $rec;
    }

}