/*
* @Author: indran
* @Date:   2018-09-10 04:24:21
* @Last Modified by:   indran
* @Last Modified time: 2018-09-10 07:26:54
*/
var block= '[{"district":"Thiruvananthapuram","block":["Athiyanoor","Chiyrayinkeezhu","Pothencode","Kilimanoor","Nedumangad","Nemom","Parassala","Perumkadavila","Vamanapuram","Varkala","Vellanad"]},{"district":"Kollam","block":["Anchal","Chadayamangalam","Chavara","Chittumala","Ithikkara","Kottarakkara","Mughathala","Oachira","Pathanapuram","Sasthamkotta","Vettikavala"]},{"district":"Pathanamthitta","block":["Mallappally","Pulikeezhu","Koipuram","Elanthoor","Ranni","Konni","Pandalam","Parakode"]},{"district":"Alappuzha","block":["Ambalapuzha","Aryad","Bharanicavu","Champakulam","Chengannur","Haripad","Kanjikuzhy","Mavelikara","Muthukulam","Pattanakkad","Thycattussery","Veliyanad"]},{"district":"Kottayam","block":["Erattupetta","Ettumannoort","Kaduthuruthy","Kanjirappally","Lalam","Madappally","Pallom","Pampady","Uzhavoor","Vazhoor","Vaikom"]},{"district":"Idukky","block":["Adimaly","Azhutha","Devikulam","Elamdesam","Idukki","Kattappana","Nedumkandam","Thodupuzha"]},{"district":"Ernakulam","block":["Alangad","Angamaly","Edappally","Koovappady","Kothamangalam","Mulanthuruthy","Moovattupuzha","Palluruthy","Pampakuda","North Paravoor","Parakadavu","Vadavucode","Vazhakulam","Vypin"]},{"district":"Thrissur","block":["Anthikkad","Chalakudy","Chavakkad","Cherpu","Chowannur","Irinjalakuda","Kodakara","Mala","Mathilakam","Mullassery","Ollukkara","Pazhayannur","Puzhakkal","Thalikulam","Vellangallur","Wadakkanchery"]},{"district":"Palakkad","block":["Alathur","Attappady (ITDP)","Chittur","Kollengode","Kuzhalmannam","Malampuzha","Mannarkad","Nenmara","Ottappalam","Palakkad","Pattambi","Sreekrishnapuram","Thrithala"]},{"district":"Malappuram","block":["Areakode","Kondotty","Kuttippuram","Malappuram","Mankada","Nilambur","Perinthalmanna","Perumpadappu","Ponnani","Thanur","Tirur","Thirurangadi","Vengara","Wandoor","Kalikavu"]},{"district":"Kozhikode","block":["Balussery","Chelannur","Koduvally","Kozhikode","Kunnamangalam","Kunnummal","Meladi","Panthalayani","Perambra","Thodannur","Tuneri","Vatakara"]},{"district":"Wayanad","block":["Kalpetta","Sulthan Bathery","Mananthavady","Panamaram"]},{"district":"Kannur","block":["Kannur","Taliparamba","Payyannur","Edakkad","Thalassery","Kuthuparamba","Iritty","Irikkur","Peravoor","Panoor","Kalliassery"]},{"district":"Kasargode","block":["Manjeswaram","Kasaragod","Kanhangad","Nileshwaram","Karaduka","Parappa"]}]';
block = JSON.parse(block);
window.getDistricts = () => {
	return block.map(a => a.district);
} ;

window.getBlocks = (district ) => {
	each = [];
	try { 
		each = block.filter(function(i) {
			if(i.district == district)
				return true;
		})[0]['block'];
	}catch(err){}
	return each;
};
