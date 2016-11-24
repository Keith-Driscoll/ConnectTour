function convertNumberToClassesString(num)
{	
	var str = "";
	var test = num;
	while(test!=0){
		
		var current = test%10;
		
		switch(current){
				
			case 1 : str = str + "Warrior";
			break;
			case 2 : str = str + "Shaman";
			break;
			case 3 : str = str + "Rogue";
			break;
			case 4 : str = str + "Paladin";
			break;
			case 5 : str = str + "Hunter";
			break;
			case 6 : str = str + "Druid";
			break;
			case 7 : str = str + "Warlock";
			break;
			case 8 : str = str + "Mage";
			break;
			case 9 : str = str + "Priest";
			break;
		}	
		
		test = Math.trunc(test / 10);
		if(test!=0){
			str = str + ", ";
		}
	}	
	return str;
}