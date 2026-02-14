function toast(msg, type) {
  const t = $("#toast");
  t.removeClass("ok err").addClass(type).text(msg).fadeIn(120);
  setTimeout(() => t.fadeOut(180), 2200);
}

$("#produtoSelect").on("change", function(){
  const id = $(this).val();
  window.location.href = "/TESTE-PHP/?page=vinculos&produto_id=" + id;
});

$("#buscaVinculo").on("keyup", function(){
  const q = $(this).val().toLowerCase();
  $("#tabelaVinculos tbody tr").each(function(){
    const txt = $(this).text().toLowerCase();
    $(this).toggle(txt.indexOf(q) > -1);
  });
});

$("#formVinculos").on("submit", function(e){
  e.preventDefault();
  if ($("#produtoSelect").val() === "0") {
    toast("Selecione um produto primeiro.", "err");
    return;
  }
});

$("#btnRemoverMarcados").on("click", function(){
  if ($("#produtoSelect").val() === "0") {
    toast("Selecione um produto primeiro.", "err");
    return;
  }
});
