var bt=document.getElementById("expandirBt");
var avaliBt=document.getElementById("avaliacoesBt");
function expandir(){
 if(bt.textContent=="Ler Mais"){
    var caixaText=document.getElementById("descricaoTx");  
bt.textContent="Ler Menos";
caixaText.style.height="auto";
}
else{
    var caixaText=document.getElementById("descricaoTx");  
    caixaText.style.height="40px";
bt.textContent="Ler Mais"};
}

function avaliacaoBt(){
 
    var caixaText=document.getElementById("avaliacaoTx");  
caixaText.style.display="inline";
}
function minimizarAvaliacao(){
 
  var caixaText=document.getElementById("avaliacaoTx");  
caixaText.style.display="none";
}

