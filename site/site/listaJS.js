var bt=document.getElementById("expandirBt");


function expandir(){
 if(bt.textContent=="Ler Mais"){
    var caixaText=document.getElementById("descricaoTx");  
   caixaText.style.height='auto';
   
bt.textContent="Ler Menos";}
else{

    var caixaText=document.getElementById("descricaoTx");  
    caixaText.style.height='40px';
bt.textContent="Ler Mais";}
}

