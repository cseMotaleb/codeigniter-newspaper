/*Compressed by JSC Version 1.0.25633
/*
Company : Mutlfirames - www.multiframes.com
Author Mohamad Cheaib Software Engineer
Email: mchoueib@hotmail.com - mohammad.choueib@multiframes.com
Copyright 2010-6-30
*/

var GLM={DOM:Object,AJAX:Object,Collection:Object};GLM.DOM.isInternetExplorer=(navigator.userAgent.indexOf("MSIE")>=0);GLM.DOM.isMozilla=(navigator.userAgent.indexOf("Gecko")>=0);GLM.DOM.isOpera=(navigator.userAgent.indexOf("Opera")>=0);GLM.DOM.isSafari=(navigator.userAgent.indexOf("Safari")>=0);GLM.Collection.Map=function(){var len=0;var keys=new Array();var values=new Array();this.get=function(key){var val=null;for(var i=0;i<len;i++){if(keys[i]==key){val=values[i];break;}}return val;};this.put=function(key,value){for(var i=0;i<len;i++){if(keys[i]==key){values[i]=value;return;}}keys[len]=key;values[len++]=value;};this.length=function(){return len;};this.contains=function(key){var con=false;for(var i=0;i<len;i++){if(keys[i]==key){con=true;break;}}return con;};this.remove=function(key){var keyArr=new Array();var valArr=new Array();var l=0;for(var i=0;i<len;i++){if(keys[i]!=key){keyArr[l]=keys[i];valArr[l++]=values[i];}}keys=keyArr;values=valArr;len=l;};};;GLM.AJAX=function(){var nameSpace="http://tempuri.org/";var map=new GLM.Collection.Map();var ajaxObject=function(){try{return new XMLHttpRequest();}catch(ex){};try{return new ActiveXObject("Microsoft.XMLHTTP");}catch(ex){};try{return new SOAPCall();}catch(ex){};};;;this.onError=function(error){alert(error);};;this.callPage=function(url,callbackFunction,method,args,async){try{var ao=ajaxObject();ao.onreadystatechange=function(){if(ao.readyState==4||ao.readyState=="complete"){callbackFunction(ao.responseText);}};if(!method)method="GET";if(!args)args=null;if(async==null)async=true;ao.open(method,url,async);if(method=="POST")ao.setRequestHeader("Content-Type","application/x-www-form-urlencoded");ao.send(args);}catch(ex){this.onError(ex);}};;this.callService=function(serviceUrl,soapMethod,callbackFunction){var callServiceError=this.onError;var ao=ajaxObject();if(!ao.encode){if(serviceUrl.indexOf("http://")<0)serviceUrl="http://"+serviceUrl;serviceUrl+="?WSDL";var soapEnvelope="<?xml version=\"1.0\" encoding=\"utf-8\"?>";soapEnvelope+="<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">";soapEnvelope+="<soap:Body>";soapEnvelope+="<"+soapMethod+" xmlns=\""+nameSpace+"\">";if(arguments.length>3){for(var i=3;i<arguments.length;i++){var params=arguments[i].split("=");soapEnvelope+="<"+params[0]+">";soapEnvelope+=params[1];soapEnvelope+="</"+params[0]+">";}}soapEnvelope+="</"+soapMethod+">";soapEnvelope+="</soap:Body>";soapEnvelope+="</soap:Envelope>";ao.onreadystatechange=function(){if(ao.readyState==4){try{var response=ao.responseXML.getElementsByTagName(soapMethod+"Result")[0];if(!response)response=ao.responseXML.getElementsByTagName(soapMethod+"Response")[0];if(!response){callServiceError("WebService does not contain a Result/Response node");return;}if(response.textContent)callbackFunction(response.textContent);else if(response.text)callbackFunction(response.text);}catch(ex){callServiceError(ex);}}};ao.open("POST",serviceUrl,true);ao.setRequestHeader("Content-Type","text/xml");ao.setRequestHeader("SOAPAction",nameSpace+soapMethod);try{ao.send(soapEnvelope);}catch(ex){serviceCallError(ex);}}else{var soapParams=new Array();var headers=new Array();var soapVersion=0;var object=nameSpace;if(serviceUrl.indexOf("http://")<0)serviceUrl=document.location+serviceUrl;ao.transportURI=serviceUrl;ao.actionURI=nameSpace+soapMethod;for(var i=3;i<arguments.length;i++){var params=arguments[i].split("=");soapParams.push(new SOAPParameter(params[1],params[0]));}try{ao.encode(soapVersion,soapMethod,object,headers.length,headers,soapParams.length,soapParams);}catch(ex){serviceCallError(ex);}try{netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");}catch(ex){return false;}try{ao.asyncInvoke(function(resp,call,status){if(resp.fault)return callServiceError(resp.fault);if(!resp.body){callServiceError("Service "+call.transportURI+" not found.");}else{try{callbackFunction(resp.body.firstChild.firstChild.firstChild.data);}catch(ex){callServiceError(ex);}}});}catch(ex){serviceCallError(ex);}}};;this.setNameSpace=function(ns){nameSpace=ns;};;this.getNameSpace=function(){return nameSpace;};};

function getURL(link, object){
	var objectString = "";
	if(object != undefined && object != null)
	{
		for(var objectField in object)
		{
			if(objectString != "")
			{
				objectString += "&";
			}
			if(object[objectField] instanceof Array == false)
			{
				objectString += encodeURIComponent(objectField) + "=" + encodeURIComponent(object[objectField]);
			}
			else
			{
				for(var i = 0; i < object[objectField].length; i++)
				{
					objectString += encodeURIComponent(objectField) + "=" + encodeURIComponent(object[objectField][i]);
					if(i  < object[objectField].length - 1)
					{
						objectString += "&";
					}
				}
			}
		}
	}
	return link+"?"+objectString;

}