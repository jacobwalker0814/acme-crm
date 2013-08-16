<?PHP

// Load the application
require_once "app/app.php";

ini_set("display_errors", true);

$contact = $app->getFactory("Contact")->model();

$contact->load(1);
print_r($contact->getData()); 
// Should print:
// id => 1,
// name => John Doe
// email => john@doe.com
echo '<br/><br/>';
echo $contact->getData('name');
//Should print:
// John Doe

$contact->setData('name', 'John Walker')->save(); //Should run an UPDATE query
echo '<br/><br/>';
print_r($contact->load(1)->getData());
//Should print
// id => 1,
// name => John Walker
// email => john@doe.com

$contact->setData(array(
"id" => 1,
"name" => "John Doe the 2nd",
"email" => "john@doe2.com"
))->save();
echo '<br/><br/>';
print_r($contact->load(1)->getData());
//Should print
// id => 1,
// name => John Doe the 2nd
// email => john@doe2.com

$newContact = $app->getFactory("Contact")->model();
$newContact->setData(array(
    "name" => "Gilbert Barber",
    "email" => "gilbTheparrot@gmail.com"
));

$newContact->save(); //Should run an INSERT query as there is no predefined id
echo '<br/><br/>';
print_r($newContact->getData());
//Should print
// id => ? some auto increment number,
// name => Gilbert Barber
// email => gilbTheparrot@gmail.com

$newContact->delete(); //Should delete him Gilbert Barber from the database
