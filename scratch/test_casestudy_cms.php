<?php
/**
 * Integration Test Suite for Case Studies CMS & Sidebar Cleanup
 */

$baseUrl = 'http://localhost/teknolite';

function makeRequest($url, $method = 'GET', $data = []) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }

    $body = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    return [
        'code' => $httpCode,
        'body' => $body,
        'error' => $error
    ];
}

echo "=== 1. Test GET /admin/casestudies ===\n";
$res1 = makeRequest($baseUrl . '/admin/casestudies');
echo "Status: " . $res1['code'] . "\n";
assert($res1['code'] === 200, "Expected 200 for admin casestudies");
assert(strpos($res1['body'], 'Case Studies CMS') !== false, "Expected 'Case Studies CMS' header");
assert(strpos($res1['body'], 'Modern Office Lighting Solution') !== false, "Expected seeded case study");
assert(strpos($res1['body'], 'Indoor Residential Lighting Collection') !== false, "Expected seeded residential case study");
echo "PASS: Admin case studies list rendered properly!\n\n";

echo "=== 2. Test GET /admin/casestudyadd ===\n";
$res2 = makeRequest($baseUrl . '/admin/casestudyadd');
echo "Status: " . $res2['code'] . "\n";
assert($res2['code'] === 200, "Expected 200 for casestudyadd page");
assert(strpos($res2['body'], 'Create New Case Study') !== false, "Expected form title");
assert(strpos($res2['body'], 'SEO Optimization & URL Slug') !== false, "Expected SEO fields");
echo "PASS: Case study create page rendered properly!\n\n";

echo "=== 3. Test POST /admin/casestudyadd ===\n";
$testTitle = "Automated Penthouse Lighting " . time();
$testSlug = "automated-penthouse-lighting-" . time();
$postData = [
    'title' => $testTitle,
    'client' => 'Skyline Skyline Developers',
    'industry' => 'Residential',
    'location' => 'Worli Sea Face, Mumbai',
    'overview' => 'Customized smart lighting design for an ultra-luxury duplex penthouse overlooking the Arabian Sea. Integrates DALI-2 architectural downlights with circadian rhythm control.',
    'status' => 'active',
    'meta_title' => $testTitle . ' | TeknoLite Project Portfolio',
    'meta_description' => 'Ultra-luxury residential penthouse lighting case study by TeknoLite.',
    'meta_keywords' => 'penthouse lighting, luxury smart lighting, DALI downlights',
    'slug' => $testSlug,
    'image_url' => 'assets/images/project/project1.jpeg'
];
$res3 = makeRequest($baseUrl . '/admin/casestudyadd', 'POST', $postData);
echo "Status: " . $res3['code'] . "\n";
assert(in_array($res3['code'], [301, 302, 303, 307]), "Expected redirect after creating case study");
echo "PASS: Case study created successfully!\n\n";

echo "=== 4. Verify Created Case Study in List & Search ===\n";
$res4 = makeRequest($baseUrl . '/admin/casestudies?search=' . urlencode($testTitle));
assert(strpos($res4['body'], $testTitle) !== false, "Expected newly created case study in search results");

// Extract the ID
preg_match('/CS-\d+/', $res4['body'], $matches);
$createdId = !empty($matches[0]) ? $matches[0] : null;
echo "Created Case Study ID: " . $createdId . "\n";
assert(!empty($createdId), "Expected valid CS-XXXX ID");
echo "PASS: Newly created case study found and verified!\n\n";

echo "=== 5. Test GET /admin/casestudyedit/{id} ===\n";
$res5 = makeRequest($baseUrl . '/admin/casestudyedit/' . $createdId);
echo "Status: " . $res5['code'] . "\n";
assert($res5['code'] === 200, "Expected 200 for casestudyedit");
assert(strpos($res5['body'], $testTitle) !== false, "Expected title pre-filled in edit form");
assert(strpos($res5['body'], 'Worli Sea Face') !== false, "Expected location pre-filled");
echo "PASS: Case study edit form pre-filled properly!\n\n";

echo "=== 6. Test POST /admin/casestudyedit/{id} ===\n";
$updatedOverview = 'Updated overview with advanced Bluetooth mesh fixtures and automated daylight harvesting sensors.';
$updateData = [
    'title' => $testTitle . ' - Revised',
    'client' => 'Skyline Skyline Developers',
    'industry' => 'Residential',
    'location' => 'Worli Sea Face, Mumbai',
    'overview' => $updatedOverview,
    'status' => 'active',
    'meta_title' => $testTitle . ' - Revised | TeknoLite',
    'meta_description' => 'Updated meta description.',
    'meta_keywords' => 'penthouse lighting, bluetooth mesh',
    'slug' => $testSlug
];
$res6 = makeRequest($baseUrl . '/admin/casestudyedit/' . $createdId, 'POST', $updateData);
echo "Status: " . $res6['code'] . "\n";
assert(in_array($res6['code'], [301, 302, 303, 307]), "Expected redirect after update");

$res6b = makeRequest($baseUrl . '/admin/casestudyedit/' . $createdId);
assert(strpos($res6b['body'], 'daylight harvesting sensors') !== false, "Expected updated overview in edit form");
echo "PASS: Case study updated successfully!\n\n";

echo "=== 7. Test Status Toggle ===\n";
$res7 = makeRequest($baseUrl . '/admin/casestudystatus/' . $createdId);
echo "Status: " . $res7['code'] . "\n";
assert(in_array($res7['code'], [301, 302, 303, 307]), "Expected redirect after status toggle");

$res7b = makeRequest($baseUrl . '/admin/casestudies?status=inactive');
assert(strpos($res7b['body'], $testTitle) !== false, "Expected case study to be inactive");

// Toggle back
makeRequest($baseUrl . '/admin/casestudystatus/' . $createdId);
$res7c = makeRequest($baseUrl . '/admin/casestudies?status=active');
assert(strpos($res7c['body'], $testTitle) !== false, "Expected case study to be active again");
echo "PASS: Case study status toggle functioning!\n\n";

echo "=== 8. Test Frontend /casestudy Listing ===\n";
$res8 = makeRequest($baseUrl . '/casestudy');
echo "Status: " . $res8['code'] . "\n";
assert($res8['code'] === 200, "Expected 200 for frontend casestudy");
assert(strpos($res8['body'], 'Modern Office Lighting Solution') !== false, "Expected case study card on frontend");
assert(strpos($res8['body'], $testSlug) !== false, "Expected test case study slug link on frontend");
echo "PASS: Frontend case studies directory rendered dynamically!\n\n";

echo "=== 9. Test Frontend /casestudydetail/{slug} ===\n";
$res9 = makeRequest($baseUrl . '/casestudydetail/' . $testSlug);
echo "Status: " . $res9['code'] . "\n";
assert($res9['code'] === 200, "Expected 200 for frontend casestudydetail");
assert(strpos($res9['body'], 'daylight harvesting sensors') !== false, "Expected custom overview content in detail page");
assert(strpos($res9['body'], 'Worli Sea Face') !== false, "Expected location in detail page");
assert(strpos($res9['body'], '<title>' . $testTitle) !== false, "Expected dynamic meta title in detail page head");
echo "PASS: Frontend case study detail page rendered dynamic content & SEO tags!\n\n";

echo "=== 10. Test Case Study Deletion ===\n";
$res10 = makeRequest($baseUrl . '/admin/casestudydelete/' . $createdId);
echo "Status: " . $res10['code'] . "\n";
assert(in_array($res10['code'], [301, 302, 303, 307]), "Expected redirect after delete");

$res10b = makeRequest($baseUrl . '/admin/casestudies?search=' . urlencode($testTitle));
assert(strpos($res10b['body'], 'No case studies found') !== false, "Expected 'No case studies found' after deletion");
assert(strpos($res10b['body'], 'admin/casestudyedit/' . $createdId) === false, "Case study edit link should not exist after deletion");
echo "PASS: Case study deleted successfully!\n\n";

echo "=== 11. Test Sidebar Cleanup (Unused Links & Dropdowns Removed) ===\n";
$res11 = makeRequest($baseUrl . '/admin/dashboard');
assert(strpos($res11['body'], 'Case Studies') !== false, "Expected 'Case Studies' in sidebar");
assert(strpos($res11['body'], '>Inventory<') === false, "Unused 'Inventory' should be removed from sidebar");
assert(strpos($res11['body'], '>Purchases<') === false, "Unused 'Purchases' should be removed from sidebar");
assert(strpos($res11['body'], '>Attributes<') === false, "Unused 'Attributes' should be removed from sidebar");
assert(strpos($res11['body'], '>Invoices<') === false, "Unused 'Invoices' should be removed from sidebar");
assert(strpos($res11['body'], '>Orders<') === false, "Orders section should be removed from sidebar");
assert(strpos($res11['body'], 'has-submenu') === false, "All dropdown 'has-submenu' classes should be removed");
assert(strpos($res11['body'], 'sidebar-submenu') === false, "All 'sidebar-submenu' lists should be removed");
assert(strpos($res11['body'], 'menu-arrow') === false, "All dropdown chevron arrows should be removed");
echo "PASS: Unused links and all dropdowns removed from sidebar; flat direct navlinks verified!\n\n";

echo "=== ALL CASE STUDIES CMS & SIDEBAR TESTS PASSED 100%! ===\n";
