;(function () {
    var products = [];
    var viewed = localStorage.getItem('viewed_products');
     if(viewed) {
         var exist;
         products = JSON.parse(viewed);
         exist = !!(~$.inArray(+product_id,products));
         if(products.length == 5){
             products.pop();
             products.push(+product_id);
             localStorage.setItem('viewed_products', JSON.stringify(products.reverse()) );
             return;
         }
         if(!exist) {
             products.push(+product_id);
             localStorage.setItem('viewed_products', JSON.stringify(products.reverse()) );
         }
     } else {
         products.push(+product_id);
         localStorage.setItem('viewed_products',JSON.stringify(products.reverse()) );
     }
}());