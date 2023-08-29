<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" type="text/javascript"></script>

</div>
<script>
$(document).ready(function(){
    $('#search-form').submit(function(e){
        e.preventDefault(); // Prevent page from reloading
        var formData = $(this).serialize(); // Serialize form data
        $.post('../src/edit.php', formData, function(data){
            $('#results').html(data); // Update search results
        });
    });
});
</script>

</body>
</html>