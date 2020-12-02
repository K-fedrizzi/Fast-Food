var btDescricao=document.querySelectorAll(".expandirBt");
var  avaliBt=document.querySelectorAll(".avaliacoesBt");
var minimizarAvBt=document.querySelectorAll(".minimizarBt");
var caixaText=document.querySelectorAll(".avaliacaoTx");  
for(var i=0; i<btDescricao.length;i++){
btDescricao[i].value=i;
avaliBt[i].value=i;
minimizarAvBt[i].value=i;
caixaText[i].value=i;
}

function expandir(value){
  var a=value;

  
   
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

function atualizarEstrela(value, idProduto, sequenciaProduto){

//var atualizado= document.getElementsByClassName("minhaAvaliacao")[sequenciaProduto].getElementsByClassName("estrelas")[0].getElementsByTagName("form")[0].getElementsByTagName("div");
 var atualizado= document.getElementsByClassName("minhaAvaliacao")[sequenciaProduto].getElementsByClassName("estrelas")[0].getElementsByClassName("estrelaMinhaAvaliacao");
  for(i=0;i<5;i++){
    if(i+1>value){
atualizado[i].innerHTML=' <img class ="estrela estrelaApagada" src="imagens/estrela.png" alt="*">';
    }
    if(i+1<=value){
      atualizado[i].innerHTML=' <img class ="estrela" src="imagens/estrela.png" alt="*">';
          }

}
var valor =document.getElementsByClassName("minhaAvaliacao")[sequenciaProduto].getElementsByClassName("valorPontuacao");
valor[0].innerHTML=""+value;  
}