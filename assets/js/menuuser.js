createMenu("0c3865", "FFFFFF", "5", "100", "space-around");
elementMenuLogo("./assets/img/logo.png", "logo");
elementMenu("Home", "index.php?action=welcome", "client", "1");
elementMenu("Invoice", "index.php?action=invoices", "client", "1");
elementMenu("Contact", "index.php?action=contacts", "client", "1");
elementMenu("Companies", "index.php?action=companies", "client", "1");
elementGroupMenu("Admin", "admin", "1", "");
elementSousMenu("New contact", "index.php?action=new_contact", "client", "1");
elementSousMenu("New invoice", "index.php?action=new_invoice", "client", "1");
elementSousMenu("New company", "index.php?action=new_company", "client", "1");
elementSousMenu("Log out", "index.php?action=logout", "client", "1");
//elementMenuLogo(url, alt);

function colorTheTable(){
    setTimeout(()=> {
        let i = 0;
        document.querySelectorAll('.line').forEach((elem) => {
            if (i % 2 === 0) elem.style.backgroundColor = "#F5F5F5";
            else elem.style.backgroundColor = "#CFE4FF";
            i++;
        })
    }, 200);
}

colorTheTable();