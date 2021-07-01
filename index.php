<html>
    <head>
        <title>PDF</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .radio{
                display: flex;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <div class = "container">
        <form class="form" action="pdf.php" method="POST">
            <ul>
                <li>
                <div class="radio">
                    <input type="radio" name="type" value="Invoice" checked>Invoice
                    <input type="radio" name="type" value="Quatation">Quatation
                </div>
                </li>
                <li>
                <div class="radio">
                    <input type="radio" name="memo" value="Cash" checked>Cash
                    <input type="radio" name="memo" value="Debit">Debit
                </div>
                </li>
                <li>
                    <label>Invoice no</label>
                    <input autocomplete="off" class="input" type="text" name="invoice" placeholder="Invoice No.">
                </li>
                <li>
                    <label>Name</label>
                    <input autocomplete="off" class="input" type="text" name="name" placeholder="Name">        
                </li>
            
                <li>
                    <label>Address</label>
                    <input class="input" autocomplete="off" type="text" name="address" placeholder="Address">
                </li>
                <li>
                    <label>Date</label>
                    <input class='input' type='date' name='date' placeholder='Date'>
                </li>
                <li>
                    <label>Place of supply</label>
                    <input class="input" type="text" autocomplete="off" name="place" placeholder="Place of Supply">
                </li>
                <li>
                    <label>GST no</label>
                    <input class="input" type="text" name="gstin" autocomplete="off" placeholder="GST No" >
                </li>
                <li>
                    <label>Product details</label>
                    <div class="p">
                        <input class="input" type="text" name="p1" placeholder="Prouduct Description 1">
            
                        <input class="input" type="text" name="p2" placeholder="Prouduct Description 2">
            
                        <input class="input" type="text" name="p3" placeholder="Prouduct Description 3">
            
                        <input class="input" type="text" name="p4" placeholder="Prouduct Description 4">
                    </div>
                </li>
                <li>
                    <label>HSN</label>
                    <input class="input" type="text" name="hsn" placeholder="HSN">
                </li>
                <li>
                    <label>Quantity</label>
                    <input autocomplete="off" class="input" type="text" name="qty" placeholder="Quantity">
                </li>
                <li>
                    <label>Rate</label>
                    <input class="input" type="text" name="rate" placeholder="Rate">
                </li>
                <li>
                    <label>IGST</label>
                    <input class="input" type="text" name="igst" placeholder="IGST" value='0'>
                </li>
                <li>
                    <label>SGST</label>
                    <input class="input" type="text" name="sgst" placeholder="SGST" value="6">
                </li>
                <li>
                    <label>CGST</label>
                    <input class="input" type="text" name="cgst" placeholder="CGST" value="6">
                </li>
                
                    
                
            </ul>
            <div class="a">
                <input class="button" type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
    </body>
</html>
