// function makeInvisible(id){
//     var product_str = ".productCatalog"+id;
//     var product = document.querySelector(product_str);
//     product = product.parentNode;
//     product.style.display="none";
// }

// function getProductList(){
//     var list = [];
//     var table = document.querySelector('.productsTable');
//     var table = table.getElementsByTagName('tr');
//     for (var i=1;i<table.length;i++){
//         var obj={};
//         obj.name = table[i].textContent;
//         obj.id = table[i].attributes[0].value;
//         list.push(obj);
//     }
//     return list;
// }

// var textArea = document.querySelector('#ProductAddToFreezerForm');
// textArea.addEventListener('keydown',function(event){
//     console.log(event.keyCode);
// })
// console.log(textArea);
// //makeInvisible(1);
