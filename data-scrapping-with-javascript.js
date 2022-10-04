/* 

Data Scrapping with Vanilla JavaScript ( Raw JS )

Tutorial Link: https://www.youtube.com/watch?v=GDJjovLJpMs 
Example Website: https://setapp.com/apps 

Date: 11th Dec 2021
*/

const items = [];

document.querySelectorAll(".all-apps-item").forEach(function(item){
	const _item = {};
	_item.name = item.querySelector('.all-apps-item__name').innerHTML.trim();
	_item.desc = item.querySelector('.all-apps-item__description').innerHTML.trim();
	_item.icon = item.querySelector('.all-apps-item__icon').getAttribute('src').trim();
	items.push( _item );
})

console.log( items );


/* For Scrap Transection History */
var items = '';
document.querySelectorAll("table.cust_table tbody tr").forEach(function(item){	 
	items += item.querySelector('td:nth-child(1) span').innerHTML + "\t";
	items += item.querySelector('td:nth-child(2)').innerHTML  + "\t";
	items += item.querySelector('td:nth-child(4) span.num').innerHTML  + "\t\r\n";	
})
console.log( items );


/* For Profile Photo */
data-imgperflogname="profileCoverPhoto";
var items = '';
document.querySelectorAll("img").forEach(function(item){	 
    console.log( item.getAttribute('src') );	
});
