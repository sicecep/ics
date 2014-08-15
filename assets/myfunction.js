/* 
 * myfunction.js
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

                        
// add by sepryharyandi@gmail.com
function replaceall(str,replace,with_this)
{
    var str_hasil ="";
    for(var i=0;i<str.length;i++)
    {
        if (str[i] == replace)
        {
            var temp = with_this;
        }
        else
        {
            var temp = str[i];
        }
        str_hasil += temp;
    }
    var result = str_hasil.toString();
    return result;
} 

// Insert Grid ok
function getData(grid,arrEx) {
	rowsnum = grid.getColumnCount();
	x = 1; data = "";
	grid.forEachRow(function(id){
		if(x==1) { spt = ""; } else { spt = "~"; }
		rows = "";
		n = 0;
		for(i=0;i<rowsnum;i++) {
			if(arrEx == "") {
				if(i==0) { sptc = ""; } else { sptc = "`"; }
				rows = rows+sptc+grid.cells(id,i).getValue(); 
			} else {
				if(include(arrEx,i)!=true) {
					if(n==0) { sptc = ""; } else { sptc = "`"; }
					rows = rows+sptc+grid.cells(id,i).getValue(); 
					n++;
				}	
			}
		}
		data = data+spt+rows;
		x++;
    });
	return data;
}

 function include(arr, obj) {
    for(var i=0; i<arr.length; i++) {
        if (arr[i] == obj) return true;
    } 
 }
 
 function pilihComboBox(zCombo,isi) {
	 	zCombo.setComboText("");
		idMdl = zCombo.getIndexByValue(isi);
		zCombo.selectOption(idMdl,true,true);	 
 }