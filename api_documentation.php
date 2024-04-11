<?php include 'navigation.php';
?>


<div class="top_space container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 p-5">
                    <h5>API</h5>
                    <p class="mb-0" style="color: #000;">You can access tandana APIs as follows.</p>
                    <a href="javascript:void(0)"><u>http://localhost/tandana2/api/getinfo.php?id=30</u></a>
                    <p style="margin: 20px 0px;color: #000;">By changing the ID at the end of the URL, you can fetch the information about different dances.</p>
                    <p style="margin-bottom: 20px;color: #000;">You can play with the API here. Try entering an ID to see the JSON response.</p>
                    <div class="form-group">
                        <h4 class="text-primary">
                            <span style="color: black;">BASE URL: </span><u>http://localhost/tandana2/api/getinfo.php?id=</u>
                            <input type="text" id="id" name="id" style="height: 40px; width: 40px;  border-radius: 10px; border: 1px solid black; color: black;">
                        </h4>
                    </div>
                    <div class="" style="display: flex; align-items: center;">
                        <div class="">
                            <span style="font-size: 15px;">Response</span>
                        </div>
                        <div style="margin-left: 5px;">
                            <textarea name="response" id="response" cols="50" rows="7" class="form-control"></textarea>
                        </div>
                    </div>
                    <div style="margin-top: 15px;">
                        <button type="button" class="btn btn-primary" id="get" style="margin-right: 10px; padding-left: 10px; padding-right: 10px;">Get Response</button>
                        <a href="admin_commands.php" class="btn btn-primary">Close</a>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>

</div>

<style type="text/css">
	.container {
    padding-top: 0 !important; 
    position: relative; 
    top: 0 !important; 
}
</style>
<script>
    $('#get').click(function(e) {
        e.preventDefault();
        var id = $('#id').val();
        $.ajax({
            type: "get",
            url: "api/getinfo.php",
            data: {
                id: id
            },
            dataType: "html",
            success: function(res) {
                $('#response').val(res);
                var data = JSON.parse(res);
                if (data.response_code == 404) {
                    $('#response').text("No Record Found");
                }
            }
        });
    });
</script>


</body>

</html>