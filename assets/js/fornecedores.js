function toast(msg, type) {
  const t = $("#toast");
  t.removeClass("ok err").addClass(type).text(msg).fadeIn(120);
  setTimeout(() => t.fadeOut(180), 2200);
}

$("#formFornecedor").on("submit", function(e){
  e.preventDefault();

  $.ajax({
    url: "ajax/fornecedor_salvar.php",
    method: "POST",
    data: $(this).serialize(),
    dataType: "json"
  }).done(function(res){
    if(res.ok){
      toast("Fornecedor salvo com sucesso!", "ok");
      setTimeout(() => location.reload(), 450);
    } else {
      toast(res.error || "Erro ao salvar.", "err");
    }
  }).fail(function(){
    toast("Falha de comunicação com o servidor.", "err");
  });
});

/* ==== Ajuste para sistema interno (admin clean) ==== */
body{
  background-image: none;
  background-color: #f6f7fb;
  color: #111;
}

main{
  max-width: 1100px;
}

section{
  background-image: none;
  background: transparent;
  padding-top: 0;
}

section div{
  background: #fff;
  border: 1px solid #e6e8ef;
  border-radius: 12px;
  box-shadow: 0 6px 22px rgba(0,0,0,.06);
  color: #111;
}

section p{
  color: #666;
}

/* inputs e botões */
input, select, textarea{
  width: 100%;
  border: 1px solid #d6daea;
  border-radius: 10px;
  padding: 10px;
  outline: none;
}

input:focus, select:focus, textarea:focus{
  border-color: #7b8cff;
}

/* tabela para listagens */
table{
  width: 100%;
  border-collapse: collapse;
  margin-top: 12px;
}

th, td{
  padding: 10px;
  border-bottom: 1px solid #eee;
  text-align: left;
}

tr:hover{
  background: #fafbff;
}
