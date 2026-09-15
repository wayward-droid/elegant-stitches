<?php
function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
function csrf_field(): string { return '<input type="hidden" name="csrf" value="'.e($_SESSION['csrf']).'">'; }
function verify_csrf(): void {
    if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf'], (string)$_POST['csrf'])) {
        http_response_code(419); exit('Your session expired. Please go back and try again.');
    }
}
function redirect(string $path): never { header('Location: '.$path); exit; }
function flash(string $type, string $message): void { $_SESSION['flash'] = [$type, $message]; }
function product_catalog(): array {
    return [
      'adire'=>['Adire',30000,'Traditional','https://images.unsplash.com/photo-1617019114583-affb34d1b3cd?auto=format&fit=crop&w=900&q=85'],
      'agbada'=>['Agbada',80000,'Traditional','https://images.unsplash.com/photo-1598808503746-f34c53b9323e?auto=format&fit=crop&w=900&q=85'],
      'ankara'=>['Ankara',28000,'Traditional','https://images.unsplash.com/photo-1594736797933-d0501ba2fe65?auto=format&fit=crop&w=900&q=85'],
      'aso-oke'=>['Aso Oke',55000,'Traditional','https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=900&q=85'],
      'atiku'=>['Atiku',38000,'Traditional','https://images.unsplash.com/photo-1506629082955-511b1aa562c8?auto=format&fit=crop&w=900&q=85'],
      'blazer'=>['Blazer',65000,'Western','https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=900&q=85'],
      'bridal-wear'=>['Bridal Wear',150000,'Bridal','https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=900&q=85'],
      'buba-and-wrapper'=>['Buba and Wrapper',45000,'Traditional','https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=900&q=85'],
      'casual-wear'=>['Casual Wear',25000,'Casual','https://images.unsplash.com/photo-1523398002811-999ca8dec234?auto=format&fit=crop&w=900&q=85'],
      'corporate-wear'=>['Corporate Wear',45000,'Western','https://images.unsplash.com/photo-1555069519-127aadedf1ee?auto=format&fit=crop&w=900&q=85'],
      'danshiki'=>['Danshiki',25000,'Traditional','https://images.unsplash.com/photo-1542060748-10c28b62716f?auto=format&fit=crop&w=900&q=85'],
      'dinner-gown'=>['Dinner Gown',75000,'Party','https://images.unsplash.com/photo-1566174053879-31528523f8ae?auto=format&fit=crop&w=900&q=85'],
      'george'=>['George',60000,'Traditional','https://images.unsplash.com/photo-1583391733981-8498408d4e28?auto=format&fit=crop&w=900&q=85'],
      'gown-dress'=>['Gown / Dress',40000,'Western','https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=900&q=85'],
      'hoodie'=>['Hoodie',28000,'Casual','https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=900&q=85'],
      'isi-agu'=>['Isi Agu',45000,'Traditional','https://images.unsplash.com/photo-1601762603339-fd61e28b698a?auto=format&fit=crop&w=900&q=85'],
      'jacket'=>['Jacket',45000,'Western','https://images.unsplash.com/photo-1551028719-00167b16eac5?auto=format&fit=crop&w=900&q=85'],
      'jeans'=>['Jeans',25000,'Casual','https://images.unsplash.com/photo-1542272604-787c3835535d?auto=format&fit=crop&w=900&q=85'],
      'jumpsuit'=>['Jumpsuit',42000,'Western','https://images.unsplash.com/photo-1581044777550-4cfa60707c03?auto=format&fit=crop&w=900&q=85'],
      'kaftan'=>['Kaftan',35000,'Traditional','https://images.unsplash.com/photo-1596783074918-c84cb06531ca?auto=format&fit=crop&w=900&q=85'],
      'kampala'=>['Kampala',29000,'Traditional','https://images.unsplash.com/photo-1618375531912-867984bdfd87?auto=format&fit=crop&w=900&q=85'],
      'kente'=>['Kente',40000,'Traditional','https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=900&q=85'],
      'lace'=>['Lace',50000,'Traditional','https://images.unsplash.com/photo-1566206091558-7f218b696731?auto=format&fit=crop&w=900&q=85'],
      'native-wear'=>['Native Wear',40000,'Traditional','https://images.unsplash.com/photo-1598808503746-f34c53b9323e?auto=format&fit=crop&w=900&q=85'],
      'party-wear'=>['Party Wear',45000,'Party','https://images.unsplash.com/photo-1568252542512-9fe8fe9c87bb?auto=format&fit=crop&w=900&q=85'],
      'polo'=>['Polo',15000,'Casual','https://images.unsplash.com/photo-1625910513413-5fc45e8d84b7?auto=format&fit=crop&w=900&q=85'],
      'school-uniform'=>['School Uniform',18000,'Uniform','https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=900&q=85'],
      'senator-wear'=>['Senator Wear',45000,'Traditional','https://images.unsplash.com/photo-1617137968427-85924c800a22?auto=format&fit=crop&w=900&q=85'],
      'shirt-and-trousers'=>['Shirt and Trousers',35000,'Western','https://images.unsplash.com/photo-1603252109303-2751441dd157?auto=format&fit=crop&w=900&q=85'],
      'skirt-and-blouse'=>['Skirt and Blouse',38000,'Western','https://images.unsplash.com/photo-1564257577054-03a9578d4d2f?auto=format&fit=crop&w=900&q=85'],
      'sleepwear'=>['Sleepwear',18000,'Casual','https://images.unsplash.com/photo-1596755389378-c31d21fd1273?auto=format&fit=crop&w=900&q=85'],
      'sportswear'=>['Sportswear',25000,'Sports','https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=900&q=85'],
      'suit'=>['Classic Suit',120000,'Western','https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=900&q=85'],
      't-shirt'=>['T-shirt',12000,'Casual','https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=900&q=85'],
      'underwear'=>['Underwear',8000,'Essentials','https://images.unsplash.com/photo-1566206091558-7f218b696731?auto=format&fit=crop&w=900&q=85'],
      'work-uniform'=>['Work Uniform',28000,'Uniform','https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=900&q=85']
    ];
}
function cart_details(): array {
    $items=[]; $total=0; $catalog=product_catalog();
    foreach (($_SESSION['cart'] ?? []) as $slug=>$qty) if(isset($catalog[$slug])) {
        [$name,$price,$category,$image]=$catalog[$slug]; $qty=max(1,(int)$qty);
        $items[] = compact('slug','name','price','category','image','qty'); $total += $price*$qty;
    }
    return [$items,$total];
}
