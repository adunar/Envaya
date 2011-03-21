function Class(){}function makeClass(b){b=b||Class;var c=function(){this.init.apply(this,arguments)};var a=function(){};a.prototype=b.prototype;c.prototype=new a;return c}function addEvent(c,b,a){if(c.addEventListener){c.addEventListener(b,a,false)}else{c.attachEvent("on"+b,a)}}function removeEvent(c,b,a){if(c.removeEventListener){c.removeEventListener(b,a,false)}else{c.detachEvent("on"+b,a)}}function _eval(x){return eval("("+x+")")}var fetchJson=(function(){var a={};return function(b,c,e){if(a[b]){setTimeout(function(){c(a[b])},1);return null}else{var d=(window.ActiveXObject&&!window.XMLHttpRequest)?new ActiveXObject("Msxml2.XMLHTTP"):new XMLHttpRequest();d.onreadystatechange=function(){if(d.readyState==4){var f=d.status;if(f==200){c(a[b]=_eval(d.responseText))}else{if(f==500){var g=_eval(d.responseText);e?e(g):alert(g.error)}else{if(f>=400){alert("HTTP Error "+f)}}}}};d.open("GET",b,true);d.send(null);return d}}})();function bind(b,a){return function(){return a(b)}}function removeChildren(a){while(a.firstChild){a.removeChild(a.firstChild)}}function removeElem(a){if(a.parentNode){a.parentNode.removeChild(a)}}function createElem(){var f=arguments[0];var d=document.createElement(f);for(var c=1;c<arguments.length;c++){var a=arguments[c];switch(typeof(a)){case"string":d.appendChild(document.createTextNode(a));break;case"object":if(a!=null){if(a.nodeName){d.appendChild(a)}else{for(var b in a){if(a.hasOwnProperty(b)){var e=a[b];if(typeof(e)=="function"){addEvent(d,b,e)}else{d[b]=a[b]}}}}}break}}return d}window.dirty=false;function setDirty(a){if(a&&!window.submitted){if(!window.onbeforeunload){window.onbeforeunload=function(){return __["page:dirty"]}}}else{window.onbeforeunload=null}window.dirty=a;return true}function ignoreDirty(){var a=window.dirty;setDirty(false);setTimeout(function(){setDirty(a)},5)}function setSubmitted(){setDirty(false);window.submitted=true;return true}function addImageLink(a){var b=/[\=\/](\d+)\/([\w\.]+)\/([\w\.]+)/.exec(a.src);if(b&&b[3]!="large.jpg"){a.style.cursor="pointer";addEvent(a,"click",function(){window.location="/pg/large_img?owner="+(b[1])+"&group="+b[2]})}}function addImageLinks(a){if(a){var d=a.getElementsByTagName("img");for(var c=0;c<d.length;c++){var b=d[c];if(b.parentNode.nodeName!="A"){addImageLink(b)}}}}function hideMessages(a){var b=document.getElementById(a);if(b){b.style.display="none"}}function languageChanged(){setTimeout(function(){var a=document.getElementById("top_language");setLang(a.options[a.selectedIndex].value)},1)}function setLang(b){var d=window.location.href;var a=document.forms[0];if(a&&a.method.toUpperCase()=="POST"){a.action="/pg/change_lang/?url="+encodeURIComponent(d)+"&lang="+b;setSubmitted();a.submit()}else{var c=d.replace(/\blang\=\w+/,"lang="+b);if(c==d){c=d+((d.indexOf("?")!=-1)?"&":"?")+"lang="+b}window.location.href=c}return false};