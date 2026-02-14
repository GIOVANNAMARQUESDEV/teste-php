$("#formProduto").on("submit", function(e){
  e.preventDefault();

  $.ajax({
    url: "ajax/produto_salvar.php",
    method: "POST",
    data: $(this).serialize(),
    dataType: "json"
  }).done(function(res){
    if(res.ok){
      toast("Produto salvo com sucesso!", "ok");
      setTimeout(() => location.reload(), 450);
    } else {
      toast(res.error || "Erro ao salvar", "err");
    }
  }).fail(function(){
    toast("Falha no servidor", "err");
  });
});
