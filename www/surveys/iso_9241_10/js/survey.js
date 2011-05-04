	var pagesArr = new Array(new Array('txt_1_','txt_2_','txt_3_','txt_4_','txd_5_','txd_6_','rd7_7_'),
							 new Array('rd7_8_','rd7_9_','rd7_10_','rd7_11_','rd7_12_','rd7_13_','txa_14_'),
							 new Array('rd7_15_','rd7_16_','rd7_17_','rd7_18_','rd7_19_','rd7_20_','txa_21_'),
							 new Array('rd7_22_','rd7_23_','rd7_24_','rd7_25_','rd7_26_','rd7_27_','txa_28_'),
							 new Array('rd7_29_','rd7_30_','rd7_31_','rd7_32_','rd7_33_','rd7_34_','txa_35_'),
							 new Array('rd7_36_','rd7_37_','rd7_38_','rd7_39_','rd7_40_','rd7_41_','txa_42_'),
							 new Array('rd7_43_','rd7_44_','rd7_45_','rd7_46_','rd7_47_','rd7_48_','txa_49_'),
							 new Array('rd7_50_','rd7_51_','rd7_52_','rd7_53_','rd7_54_','rd7_55_','txa_56_'),
							 new Array('txd_57_','txd_58_','txd_59_','txd_60_','txd_61_','ra6_62_','ra2_63_','txt_64_','txa_65_'));
	
	
    function validatePage(nr){
    	//alert('validatePage(' + nr + '):' + pagesArr.length );
    	var errorMessage = '';
    	var errorMessageValues = '';
    	var returnValue;
    	
    	if (pagesArr.length < nr){
    		alert('ERROR: Validatoin array is not found');
    	}
    	
    	
   		for(var i = 0; i < pagesArr[nr].length; i++){
   			//alert(pagesArr[nr][i]);
   			returnValue = validateControl(pagesArr[nr][i]);
   			//alert('validateControl(' + pagesArr[nr][i] + ')=' + returnValue);
   			
   			if (!returnValue){
   				errorMessage = errorMessage + '\t* ' +pagesArr[nr][i] + '\n';
   			}else{
   				// validate value of element if filled
   				returnValue = validateControlValue(pagesArr[nr][i]);
   				//alert('validateControl(' + pagesArr[nr][i] + ')=' + returnValue);
   				if (!returnValue){
   					errorMessageValues = errorMessageValues + '\t* ' +pagesArr[nr][i] + '\n';
   				}
   			}   			
   			
   		}

    	if (errorMessage || errorMessageValues){
    		if (errorMessage) {
    			errorMessage = 'Füllen Sie bitte folgende Felder aus:\n\n' + errorMessage + '\n\n';
    		}
    		if (errorMessageValues){
    			errorMessageValues = 'Korregieren Sie bitte folgende Felder :\n\n' + errorMessageValues;
    		} 
    		alert(errorMessage + errorMessageValues);
    		return false;
		}
    
      return true;
    }
    
    function validateControl(id){
    	var controlType = id.substring(0,3);

    	
		//alert('validateControl(' + controlType + ')');
    	
		if (controlType == 'txt' || controlType == 'txd' || controlType == 'txa'){
			oElement = document.getElementById(id);
			if (!oElement){
				return false;
			}

			if(oElement.value == ''){
				return false;
			}
			return true;
		}else if (controlType == 'rd7'){
			
			for(var i=1;i<=7;i++){
				oElement = document.getElementById(id + '_' + i);
				
				//alert(oElement);
				//alert(id + '_' + i + ':' + oElement.checked);
				
				if (!oElement){
					return false;
				}
						
				if(oElement.checked){
					return true;
				}
			}
				
			return false;
		}else if (controlType == 'ra6'){
			
			for(var i=1;i<=6;i++){
				oElement = document.getElementById(id + '_' + i);
				
				if (!oElement){
						return false;
				}
						
				if(oElement.checked){
					return true;
				}
			}
			return false;
		}else if (controlType == 'ra2'){
			
			for(var i=1;i<=2;i++){
				oElement = document.getElementById(id + '_' + i);
				
				if (!oElement){
						return false;
				}
						
				if(oElement.checked){
					return true;
				}
			}
			return false;
		}
    	
    	return false;
    
    }
    
function validateControlValue(id){
    	var controlType = id.substring(0,3);

    	
		//alert('validateControl(' + controlType + ')');
    	
		if (controlType == 'txt' || controlType == 'txd' || controlType == 'txa'){
			oElement = document.getElementById(id);
			if (!oElement){
				return false;
			}

			if(oElement.value == ''){
				return false;
			}
			
			
			if (id == 'txd_5_'){
				if(oElement.value > 1200){
					return false;
				}		
			}

			if (id == 'txd_6_'){
				if(oElement.value > 168){
					return false;
				}		
			}
			
			if (id == 'txd_57_'){
				if(oElement.value > 168){
					return false;
				}		
			}			
			
			if (id == 'txd_58_'){
				if(oElement.value > 168){
					return false;
				}		
			}			

			if (id == 'txd_59_'){
				if(oElement.value > 100){
					return false;
				}		
			}			

			if (id == 'txd_60_'){
				if(oElement.value > 100){
					return false;
				}		
			}			

			if (id == 'txd_61_'){
				if(oElement.value > 24){
					return false;
				}		
			}			
			
			return true;
		}
    	
    	return true;
    
    }