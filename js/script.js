document.addEventListener('DOMContentLoaded', function() {
    var deleteLinks = document.querySelectorAll('a.delete');

    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            if (!confirm('Você tem certeza que deseja deletar esse item?')) {
                event.preventDefault();
            }
        });
    });

    var searchInput = document.getElementById('search');
    var searchButton = document.getElementById('searchButton');

    function filterItems() {
        var filter = searchInput.value.toLowerCase();
        var table = document.getElementById('itemsTable');
        var rows = table.getElementsByTagName('tr');

        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var match = false;
            for (var j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }
            if (match) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }

    searchButton.addEventListener('click', filterItems);
    searchInput.addEventListener('keyup', filterItems);
});
