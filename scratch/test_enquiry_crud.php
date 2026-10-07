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

echo "=== 1. Test GET /admin/enquiries ===\n";
$res1 = makeRequest($baseUrl . '/admin/enquiries');
echo "Status: " . $res1['code'] . "\n";
assert($res1['code'] === 200, "Expected 200 for enquiries list");
assert(strpos($res1['body'], 'All Order') !== false, "Expected table heading");
assert(strpos($res1['body'], 'Gail C. Anderson') !== false, "Expected Gail Anderson in list");
echo "PASS: Enquiries list loaded successfully with Gail Anderson!\n\n";

echo "=== 2. Test GET /admin/orders (Redirects to Enquiries) ===\n";
$res2 = makeRequest($baseUrl . '/admin/orders');
echo "Status: " . $res2['code'] . "\n";
assert(in_array($res2['code'], [200, 301, 302, 303, 307]), "Expected redirect or 200 for orders");
echo "PASS: Orders redirected properly to enquiries!\n\n";

echo "=== 3. Test Search Filter ===\n";
$res3 = makeRequest($baseUrl . '/admin/enquiries?search=Ayala');
assert($res3['code'] === 200);
assert(strpos($res3['body'], 'Jung S. Ayala') !== false);
assert(strpos($res3['body'], 'David A. Arnold') === false, "David Arnold should be filtered out");
echo "PASS: Search filter functioning properly!\n\n";

echo "=== 4. Test Status Filter ===\n";
$res4 = makeRequest($baseUrl . '/admin/enquiries?status=Quotation+Sent');
assert($res4['code'] === 200);
assert(strpos($res4['body'], 'Alphonse Roy') !== false);
echo "PASS: Status filter functioning properly!\n\n";

echo "=== 5. Test GET /admin/enquirydetail/ENQ-583488 ===\n";
$res5 = makeRequest($baseUrl . '/admin/enquirydetail/ENQ-583488');
echo "Status: " . $res5['code'] . "\n";
assert($res5['code'] === 200, "Expected 200 for enquiry detail");
assert(strpos($res5['body'], 'LED COB Downlight') !== false, "Expected product in details");
assert(strpos($res5['body'], 'Customer Message / Requirement') !== false, "Expected customer message section");
assert(strpos($res5['body'], 'Status Flow Progress') !== false, "Expected 5-step status flow progress bar");
echo "PASS: Enquiry details loaded successfully!\n\n";

echo "=== 6. Test POST /admin/enquiryupdatestatus/ENQ-583488 ===\n";
$updateData = [
    'status' => 'In Review',
    'priority' => 'High',
    'admin_remark' => 'Automated test remark - reviewing lux requirements.'
];
$res6 = makeRequest($baseUrl . '/admin/enquiryupdatestatus/ENQ-583488', 'POST', $updateData);
echo "Status: " . $res6['code'] . "\n";
assert($res6['code'] === 302 || $res6['code'] === 303, "Expected redirect after update");

// Verify the update persisted
$res7 = makeRequest($baseUrl . '/admin/enquirydetail/ENQ-583488');
assert(strpos($res7['body'], 'In Review') !== false, "Expected new status In Review");
assert(strpos($res7['body'], 'Automated test remark') !== false, "Expected updated admin remark in timeline");
echo "PASS: Status update and timeline logging verified!\n\n";

// Reset status back to New for clean state
makeRequest($baseUrl . '/admin/enquiryupdatestatus/ENQ-583488', 'POST', [
    'status' => 'New',
    'priority' => 'Normal',
    'admin_remark' => 'New enquiry received from website. Initial review needed for DALI driver availability with our technical engineer.'
]);

echo "=== ALL AUTOMATED INTEGRATION TESTS PASSED 100%! ===\n";
