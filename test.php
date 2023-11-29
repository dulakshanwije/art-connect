<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="tab-pane fade show" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <form class="form-inline d-flex justify-content-around">
                        <div class="form-group mx-sm-3 mb-2 col-12">
                            <input type="text" class="form-control my-5 mx-0 col-12" id="searchItem" placeholder="Search for Products" onkeyup="showProduct(this.value)">
                        </div>
                    </form>
                    <form method="GET" id="form-id-1" action = "myaction.php">
                        <div class="form-group">
                            <select multiple class="form-control" id="controlSelect" onclick = "selectProductItem(this.value , this.options[this.selectedIndex].text)" name = "selectProduct">
                            </select>
                        </div>
                    </form>
                    <script>
                        function showProduct(str) {
                        var xhttp;
                        if (str.length == 0) { 
                            document.getElementById("controlSelect").innerHTML = "";
                            return;
                        }
                        xhttp = new XMLHttpRequest();
                        xhttp.responseType = 'json';
                        xhttp.onreadystatechange = function() {
                            document.getElementById("controlSelect").innerHTML = "";
                            var data;
                            if (this.readyState == 4 && this.status == 200) {
                               data = this.response;
                            }
                            data?.forEach(obj => {
                                let op = document.createElement('option');
                                op.textContent = obj.name;
                                op.value = obj.id;
                                document.getElementById("controlSelect").appendChild(op);
                            });   
                        }
                        xhttp.open("GET", "admin/apis/getProducts.php?q="+str, true);
                        xhttp.send();
                    }

                    let count = 1;

                    function selectProductItem(value, text){
                        let ele_name = "product_" + count;
                        let form_parent = document.getElementById("selected-items-list");
                        let new_input = document.createElement("input");
                        let label_input = document.createElement("label");
                        
                        new_input.setAttribute("type", "text");
                        new_input.setAttribute("value", value);
                        new_input.setAttribute("name", ele_name);
                        new_input.setAttribute("id", ele_name);
                        // new_input.style.display = "none";
                        
                        label_input.setAttribute("for" , ele_name);
                        label_input.innerHTML = text;
                        form_parent.appendChild(new_input);
                        form_parent.appendChild(label_input);

                        form_parent.setAttribute("action", "get_selected.php?count=" + count);
                        count++;
                    }
                    </script>
                    </div>
                    <div>
                        <form action="" id="selected-items-list" method="POST">
                            <input type="submit" value="Submit">
                        </form>
                    </div>
</body>
</html>