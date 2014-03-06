// e.parameter has value
// 1. method = 
//   'open' to open a file and extract document parameters, 
//   'create' to build and produce a Google document
// 2. gid, Google doc ID
function doGet(e) {
//  var method = e.parameter.method;
//  var gDocId = e.parameter.gid;
  var method = 'create';
  var gDocId = '1LCxqRRPChqg0zAnYnzhA36gR7ndAg1_M23nQH0XVCGM';
  
  Logger.log("Accessing file id %s", gDocId);
  Logger.log("Method %s", method);
  Logger.log("Now %s", moment().format('YYYYMMDDHHmmss'));
  
  if (method === 'open') {
    return open(gDocId);
  }
  else if (method === 'create') {
    data = {
      
    };
    return createCopy(gDocId, data);
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

function doPost(e) {
  var gDocId = e.parameter.gid;
  
  for (key in e.parameter) {
    Logger.log(key + ": " + e.parameter[key]);
  }
  return ContentService.createTextOutput("User says: " + JSON.stringify(e)).setMimeType(ContentService.MimeType.JSON);
}

function createCopy(gDocId, data) {
  // 1. duplicate doc
  // 2. put under history folder
  // 3. replace fields value
  // 4. return download link
  
  var originalDoc = DocsList.getFileById(gDocId);  
  var newFileName = originalDoc.getName().replace('Template ', '') + '.' + moment().format('YYYYMMDDHHmmss');

  var historyFolder;  
  var folders = DriveApp.getFoldersByName('History');
  while (folders.hasNext()) {
    historyFolder = folders.next();
  }
  
  var templateDoc = DriveApp.getFileById(gDocId);
  var workingDoc = templateDoc.makeCopy(newFileName, historyFolder);
  var document = DocumentApp.openById(workingDoc.getId());
  var body = document.getBody();
  body.replaceText(searchPattern, replacement);
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

function data() {
}