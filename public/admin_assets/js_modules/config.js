var server = window.location.hostname;

if(server == 'jentayu.dev' || server == '127.0.0.1')
{
  var webUrl = "http://jentayu.dev/";
}
else if(server == 'localhost')
{
  var webUrl = "http://" + server + "/jentayu/";
}
else
{
  var webUrl = "http://" + server + "/jentayu/public/";
}

var apiUrl = webUrl + "api/";
var adminUrl = webUrl + "admin/";

var appConfig = {"webUrl":webUrl, "apiUrl" : apiUrl, "adminUrl": adminUrl, "module_access":""};
