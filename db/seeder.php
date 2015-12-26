<?PHP

require_once 'adlister_login.php';
require_once 'db_connect.php';

$clearData = 'TRUNCATE ads';

$dbc->exec($clearData);

$ads = [
    ['title' => 'Dryer', 'price' => '50', 'location' => 'Austin, TX', 'description' => 'This dryer is amazing. It dries and folds your laundry!', 'image_url' => '...', 'method' => 'phone', 'categories' => 'antique'],
    
    ['title' => 'hanger', 'price' => '70', 'location' => 'Bucktown, TX', 'description' => 'One hanger, plastic and in mint condition.', 'image_url' => '...', 'method' => 'email', 'categories' => 'antique'],

    ['title' => 'used sock', 'price' => '60', 'location' => 'Dee Eff Dub, TX', 'description' => 'One used sock, missing its partner, but still useful. Condition is pretty darn good. Wash first.', 'image_url' => '...', 'method' => 'text', 'categories' => 'antique'],

    ['title' => 'Fake Jays', 'price' => '53.27', 'location' => 'Austin, TX', 'description' => 'I have no idea what these are. Call Zee at 555-123-4567.', 'image_url' => '...', 'method' => 'phone', 'categories' => 'antique'],

    ['title' => 'Bbq pit', 'price' => '250', 'location' => 'Lockhart, TX', 'description' => 'This is Texas! You need a bbq. Do yourself a favor and buy this one!', 'image_url' => '...', 'method' => 'phone', 'categories' => 'antique'],

    ['title' => 'Dryer', 'price' => '2.50', 'location' => 'Austin, TX', 'description' => 'Dryer, is great condition. Still works! Universal plug!', 'image_url' => '...', 'method' => 'email', 'categories' => 'antique'],

    ['title' => 'bird\'s nest', 'price' => '0.50', 'location' => 'San Antonio, TX', 'description' => 'Need a home for your pet bird? Or how about a home for that pesky neighborhood raven?', 'image_url' => '...', 'method' => 'phone', 'categories' => 'antique'],

    ['title' => 'Cat', 'price' => '0.00', 'location' => 'Alamo Heights, TX', 'description' => 'Cat, slight limp, one eye. Still purrs!', 'image_url'=>'...', 'method' => 'phone', 'categories' => 'antique']
];

$query = "INSERT INTO ads (user_id, method, image_url, title, price, location, description, categories) 
			VALUES (:user_id, 
                :method,
                :image_url,
                :title, 
    			:price, 
    			:location, 
    			:description,
                :categories)";


$stmt = $dbc->prepare($query);

foreach ($ads as $ad) {
    $stmt->bindValue(':user_id', rand(1, 3), PDO::PARAM_INT);
    $stmt->bindValue(':method', $ad['method'], PDO::PARAM_STR);
    $stmt->bindValue(':image_url', $ad['image_url'], PDO::PARAM_STR);
    $stmt->bindValue(':title', $ad['title'], PDO::PARAM_STR);
    $stmt->bindValue(':price', $ad['price'], PDO::PARAM_STR);
    $stmt->bindValue(':location', $ad['location'], PDO::PARAM_STR);
    $stmt->bindValue(':description', $ad['description'], PDO::PARAM_STR);
    $stmt->bindValue(':categories', $ad['categories'], PDO::PARAM_STR);
	$stmt->execute();

    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
}

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";