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
	items += item.querySelector('td:nth-child(4)').innerText  + "\t\r\n";	
})
console.log( items );


/* Set & Get From Localstorage */
var bb = localStorage.getItem('bb');
var items = '';
document.querySelectorAll("table.cust_table tbody tr").forEach(function(item){	 
	items += item.querySelector('td:nth-child(1) span').innerHTML + "\t";
	items += item.querySelector('td:nth-child(2)').innerHTML  + "\t";
	items += item.querySelector('td:nth-child(4)').innerText  + "\t\r\n";	
})
localStorage.setItem('bb', ( bb + items) );




/* For Profile Photo */
data-imgperflogname="profileCoverPhoto";
var items = '';
document.querySelectorAll("img").forEach(function(item){	 
    console.log( item.getAttribute('src') );	
});



/* For Code Canyone */
/* https://codecanyon.net/user/activeitzone/portfolio */
var items = '';
document.querySelectorAll("ul li.js-google-analytics__list-event-container").forEach(function(item){	 
	items += item.querySelector('.product-list__heading a').innerHTML + "\t";
	items += item.querySelector('.product-list__price-desktop').innerHTML  + "\t";
	items += item.querySelector('.product-list__sales-desktop').innerText  + "\t\r\n";	
})
console.log( items );
