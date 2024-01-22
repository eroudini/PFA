// function qui permet de stocker les variables dans le local storage
function savePanier(panier){

    // JSON.stringify transforme quelques chose de complexe en chaine de caracteres
    localStorage.setItem("panier", JSON.stringify(panier));

}

function getPanier(){
    let panier = localStorage.getItem("panier");

    if(panier == null){
        return [];
    }else{
        // json.parse remet de nouveau la chaine de caracteres en objet
        return JSON.parse(JSON.stringify(panier));
    }
}

// function add qui permet l'ajout de produit dans le panier
function addPanier(produit){
    let panier = getPanier();
    let foundProduit = panier.find(produit => panier.id == produit.id);
    // si foundproduit est différent de undefined
    if(foundProduit != undefined){
        foundProduit.quantity++;
    }else{
        // si il est undefined 
        produit.quantity = 1;
        panier.push(produit);
    }
    savePanier(panier);
}
// ecouteur d'évenement pour l'ajout de produit
let btnpanier = document.querySelector('.panier');
btnpanier.addEventListener('click', addPanier);



// function qui permet de supprimer des produit dans le panier
function removeProduit(produit){
    let panier = getpanier();
    panier = panier.filter(panier => panier.id != produit.id);
    savePanier(panier);

}

// function qui permet de modifier la quantity

function changeQuantity(produit, quantity){
    let panier = getpanier();
    let foundProduit = panier.find(produit => panier.id == produit.id);

    if(foundProduit != undefined){
        foundProduit.quantity += quantity;
        // le cas ou la quantity arrive a 0
        if (foundProduit.quantity <= 0){
            removeProduit(foundProduit);
        }else{
            savePanier(panier);
        }
    }
    savePanier(panier);
}

// function total produit dans le panier
function getNombreProduit(){
    let panier = getPanier();
    let nombre = 0;

    for(let produit of panier){
        nombre += produit.quantity;
   }
   return nombre; 
}
// function prix total
function getTotalPrix(){
    let panier = getPanier();
    let total = 0;
    for (let produit of panier){
        nombre += produit.quantity * produit.prix
    }
    return nombre;

}

    
