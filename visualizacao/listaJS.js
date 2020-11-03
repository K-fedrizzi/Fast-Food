var btDescricao=document.querySelectorAll(".expandirBt");
var  avaliBt=document.querySelectorAll(".avaliacoesBt");
var minimizarAvBt=document.querySelectorAll(".minimizarBt");
var caixaText=document.querySelectorAll(".avaliacaoTx");  
for(var i=0; i<btDescricao.length;i++){
btDescricao[i].value=i;
avaliBt[i].value=i;
minimizarAvBt[i].value=i;
caixaText[i].value=i;
 console.log(btDescricao[i].value);
}

function expandir(value){
  var a=value;
  console.log(value);
  
   
    if(btDescricao[a].textContent=="Ler Mais"){
        var caixaText=document.querySelectorAll(".descricaoTx");  
    btDescricao[a].textContent="Ler Menos";
    caixaText[a].style.height="auto";

    }
    else if(btDescricao[a].textContent=="Ler Menos"){
        var caixaText=document.querySelectorAll(".descricaoTx");  
        caixaText[a].style.height="40px";
    btDescricao[a].textContent="Ler Mais"};

    }
  

function avaliacaoBt(value){
  var a=value;
 
  
caixaText[a].style.display="inline";


}
function minimizarAvaliacao(value){
  var a=value;

  
caixaText[a].style.display="none";


}

