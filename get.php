<html>
<body>

<h1>Output</h2> <br/>

<?php
// the oop way 
class formatData {                                  // make a class
    private $data;                                  // private var for class

    function __construct() {
        $this->data = isset($_POST['data']) ? $_POST['data'] : null; //fancy initialization 
    }

    function main() {                               // main function
        if (empty($this->data)) {
            throw new Exception("Empty");           // say something when empty form submit 
        }
        else{
            $email = preg_split( "/[\s,]+/", $this->data);          // make an array 
            $domain =[];                                            // new array to store domains, just using to ease other wise can edit the same array 
            foreach (array_keys($email) as $e) {                    // loop through array 
                if(filter_var($email[$e], FILTER_VALIDATE_EMAIL )) {    // verify emails 
                    $domain[$e] = array_pop(explode('@', $email[$e]));  // replace email domain in array
                    // echo 'email domain ----- ' . $email[$e] . '<br/>'; // little debug check
                }
            }
            $domain = array_unique($domain);                                // filter unique in array
            foreach (array_keys($domain) as $k) {                           // I am checking values with keys
                if(filter_var($email[$k], FILTER_VALIDATE_EMAIL )){         // this line is not perfect solution for now but I can change it later 
                    echo 'Unique ->  ' . $domain[$k] . '<br/>';             // print domain names with tld
                }
                else {
                    echo 'Unique but not email ->  ' . $domain[$k] . '<br/>';   // won't do much as if now.
                }
            }
        }
    }
}

$fdata = new formatData();                  // get a new class instance 

if(!empty($_POST))                          // if something in post 
{
    $fdata->main();                         // call main function
}

?>

</body>
</html> 