//v.3.6 build 130619

/*
Copyright Dinamenta, UAB http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/
function eXcell_3but(a){this.cell=a;this.grid=this.cell.parentNode.grid;this.edit=function(){};this.isDisabled=function(){return!0};this.detach=function(){};this.setValue=function(a){this.cell.val=a;this.cell.innerHTML="<input type='button' value='1'/><input type='button' value='2'/><input type='button' value='3'/>";this.cell.childNodes[0].onclick=function(){a3but_f1(this.parentNode.parentNode.idd,this.parentNode._cellIndex)};this.cell.childNodes[1].onclick=function(){a3but_f2(this.parentNode.parentNode.idd,
this.parentNode._cellIndex)};this.cell.childNodes[2].onclick=function(){a3but_f3(this.parentNode.parentNode.idd,this.parentNode._cellIndex)}};this.getValue=function(){return this.cell.val||""}}eXcell_3but.prototype=new eXcell;

//v.3.6 build 130619

/*
Copyright Dinamenta, UAB http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/