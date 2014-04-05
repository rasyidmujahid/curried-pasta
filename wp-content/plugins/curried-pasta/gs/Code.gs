// e.parameter has value
// 1. method = 
//   'open' to open a file and extract document parameters, 
//   'create' to build and produce a Google document
// 2. gid, Google doc ID
function doGet(e) {
  if (!e) {
    e = {
      parameter: {
        method: "create",
        gid: '1LCxqRRPChqg0zAnYnzhA36gR7ndAg1_M23nQH0XVCGM',
        nama_perusahaan: 'PLN'
      }
    };
  }
  var method = e.parameter.method;
  var gDocId = e.parameter.gid;
  
  Logger.log("Accessing file id %s", gDocId);
  Logger.log("Method %s", method);
  Logger.log("Now %s", moment().format('YYYYMMDDHHmmss'));
  
  if (method === 'open') {
    return open(gDocId);
  } else if (method === 'create') {
    return createCopy(gDocId, e.parameter);
  }
}

function open(gDocId) {
  var doc = DocumentApp.openById(gDocId);
  var body = doc.getBody();
  var content = body.getText();
  
  var docArgs = extractDocArgs(content);
  Logger.log("docArgs %s", docArgs);
  var json = ContentService.createTextOutput(JSON.stringify(docArgs)).setMimeType(ContentService.MimeType.JSON);
  Logger.log("JSON %s", json);
  return json;
}

function createCopy(gDocId, data) {
  // 1. duplicate doc
  // 2. put under history folder
  // 3. replace fields value
  // 4. return download link
  
  var originalDoc = DocsList.getFileById(gDocId);  
  var newFileName = originalDoc.getName().replace('Template ', '') + '.' + moment().format('YYYYMMDDHHmmss');
  
  Logger.log("create new file name " + newFileName);

  var historyFolder;  
  var folders = DriveApp.getFoldersByName('History');
  while (folders.hasNext()) {
    historyFolder = folders.next();
  }
  
  var templateDoc = DriveApp.getFileById(gDocId);
  var workingDoc = templateDoc.makeCopy(newFileName, historyFolder);
  var document = DocumentApp.openById(workingDoc.getId());
  var body = document.getBody();
  
  // replace fields with user-provided values
  for (key in data) {
    if (key === 'callback' || key === '_' || key === 'gid' || key === 'method') continue;
    var search = "\\$\\{" + key.toUpperCase().replace(/_/g,' ') + "\\}";
    var element = body.replaceText(search, data[key]);
  }
  
  document.saveAndClose();
  workingDoc.setSharing(DriveApp.Access.ANYONE_WITH_LINK, DriveApp.Permission.VIEW);
      
  authorize();
  var apiKey = 'AIzaSyDsLzopZdS7r57cQmyF9u7cNkUn6eXrEz4';
  var driveGetUrl = 'https://www.googleapis.com/drive/v2/files/' + workingDoc.getId() + '?key=' + apiKey;
  
  var driveResponse = UrlFetchApp.fetch(driveGetUrl);
  var driveGetJson = JSON.parse(driveResponse);
  var response = {
    pdf: driveGetJson["exportLinks"]["application/pdf"],
    embed: driveGetJson["embedLink"]
  };
  
  Logger.log(response);
  
  return ContentService.createTextOutput(data.callback + "(" + JSON.stringify(response) + ")").setMimeType(ContentService.MimeType.JSON);
}

function extractDocArgs(content) {
  var params = [];
  var regex = /\${(.*?)}/g;
  var tag = regex.exec(content);
  while (tag !== null) {
    var obj = {
      tag_id: tag[0],
      tag_string: tag[1]
    }
    params.push(obj);
    tag = regex.exec(content);
  }
  return params;
}

function authorize() {
  var oauthConfig = UrlFetchApp.addOAuthService("drive");
  var scope = "https://www.googleapis.com/auth/drive";
  oauthConfig.setConsumerKey("anonymous");
  oauthConfig.setConsumerSecret("anonymous");
  oauthConfig.setRequestTokenUrl("https://www.google.com/accounts/OAuthGetRequestToken?scope="+scope);
  oauthConfig.setAuthorizationUrl("https://accounts.google.com/OAuthAuthorizeToken");    
  oauthConfig.setAccessTokenUrl("https://www.google.com/accounts/OAuthGetAccessToken");  
}