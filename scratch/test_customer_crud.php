<?php

$baseUrl = 'http://localhost/teknolite';

function makeRequest($url, $method = 'GET', $data = []) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }
    
    $body = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return ['code' => $httpCode, 'body' => $body];
}

echo "=== 1. Test GET /admin/customers ===\n";
$res1 = makeRequest($baseUrl . '/admin/customers');
echo "Status: " . $res1['code'] . "\n";
assert($res1['code'] === 200, "Expected 200 for customer list");
assert(strpos($res1['body'], 'Registered Customer Directory') !== false, "Expected title in customer list");
assert(strpos($res1['body'], 'Gail C. Anderson') !== false, "Expected Gail C. Anderson in list");
assert(strpos($res1['body'], '27AABCW9603R1ZN') !== false, "Expected GST number in list");
echo "PASS: Customer list page rendered properly!\n\n";

echo "=== 2. Test Customer Search Filter ===\n";
$res2 = makeRequest($baseUrl . '/admin/customers?search=Ayala');
assert($res2['code'] === 200);
assert(strpos($res2['body'], 'Jung S. Ayala') !== false);
assert(strpos($res2['body'], 'David A. Arnold') === false, "Arnold should be filtered out");
echo "PASS: Customer search filter functioning!\n\n";

echo "=== 3. Test Customer Status Filter ===\n";
$res3 = makeRequest($baseUrl . '/admin/customers?status=inactive');
assert($res3['code'] === 200);
assert(strpos($res3['body'], 'Pierpont Marleau') !== false, "Pierpont should be inactive");
echo "PASS: Customer status filter functioning!\n\n";

echo "=== 4. Test GET /admin/customerprofile/CUST-1001 ===\n";
$res4 = makeRequest($baseUrl . '/admin/customerprofile/CUST-1001');
echo "Status: " . $res4['code'] . "\n";
assert($res4['code'] === 200, "Expected 200 for customer profile");
assert(strpos($res4['body'], 'Wilson') !== false, "Expected company name");
assert(strpos($res4['body'], 'Customer Enquiry &amp; Quotation History') !== false || strpos($res4['body'], 'Customer Enquiry & Quotation History') !== false, "Expected enquiry history header");
assert(strpos($res4['body'], '#583488') !== false || strpos($res4['body'], 'ENQ-583488') !== false, "Expected Gail's enquiry #583488 in enquiry history");
echo "PASS: Customer profile & enquiry history rendered properly!\n\n";

echo "=== 5. Test Customer Status Toggle ===\n";
$res5 = makeRequest($baseUrl . '/admin/customerstatus/CUST-1001');
echo "Status: " . $res5['code'] . "\n";
assert(in_array($res5['code'], [301, 302, 303, 307]), "Expected redirect after toggle");

// Check if now inactive
$res5b = makeRequest($baseUrl . '/admin/customers?status=inactive');
assert(strpos($res5b['body'], 'Gail C. Anderson') !== false, "Gail should now be inactive");

// Toggle back to active
makeRequest($baseUrl . '/admin/customerstatus/CUST-1001');
$res5c = makeRequest($baseUrl . '/admin/customers?status=active');
assert(strpos($res5c['body'], 'Gail C. Anderson') !== false, "Gail should be active again");
echo "PASS: Customer status toggle functioning!\n\n";

echo "=== 6. Test GET /admin/settings ===\n";
$res6 = makeRequest($baseUrl . '/admin/settings');
echo "Status: " . $res6['code'] . "\n";
assert($res6['code'] === 200, "Expected 200 for settings page");
assert(strpos($res6['body'], 'General Settings') !== false, "Expected General Settings");
assert(strpos($res6['body'], 'Store Settings') !== false, "Expected Store Settings");
assert(strpos($res6['body'], 'Localization Settings') !== false, "Expected Localization Settings");
assert(strpos($res6['body'], 'Customers Settings') !== false, "Expected Customers Settings");
assert(strpos($res6['body'], 'Default Tax Rate') !== false, "Expected Tax Rate in settings");
echo "PASS: Settings page rendered properly matching Twig template!\n\n";

echo "=== 7. Test POST /admin/savesettings ===\n";
$postData = [
    'meta_title' => 'TeknoLite - Architectural Lighting Studio & Fixtures',
    'store_name' => 'TeknoLite Official Store',
    'default_tax_rate' => '18%',
    'customers_online' => 'yes'
];
$res7 = makeRequest($baseUrl . '/admin/savesettings', 'POST', $postData);
echo "Status: " . $res7['code'] . "\n";
assert(in_array($res7['code'], [301, 302, 303, 307]), "Expected redirect after saving settings");

// Verify settings updated
$res8 = makeRequest($baseUrl . '/admin/settings');
assert(strpos($res8['body'], 'TeknoLite Official Store') !== false, "Expected updated store name");
echo "PASS: Settings save and persistence functioning!\n\n";

echo "=== ALL CUSTOMER MANAGEMENT & SETTINGS TESTS PASSED 100%! ===\n";
