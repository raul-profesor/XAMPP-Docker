function deltask (id) { if (confirm("Eliminar tarea?")) {
    document.getElementById("ninID").value = id;
    document.getElementById("ninForm").submit();
  }}