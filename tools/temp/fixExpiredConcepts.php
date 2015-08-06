<?php
/**
 * OpenSKOS
 *
 * LICENSE
 *
 * This source file is subject to the GPLv3 license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   OpenSKOS
 * @package    OpenSKOS
 * @copyright  Copyright (c) 2015 Pictura Database Publishing. (http://www.pictura-dp.nl)
 * @author     Alexandar Mitsev
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt GPLv3
 */


include dirname(__FILE__) . '/../autoload.inc.php';

/* 
 * Updates the status expired to status obsolete
 */

require_once 'Zend/Console/Getopt.php';
$opts = array(
	'env|e=s' => 'The environment to use (defaults to "production")',
);

try {
	$OPTS = new Zend_Console_Getopt($opts);
} catch (Zend_Console_Getopt_Exception $e) {
	fwrite(STDERR, $e->getMessage()."\n");
	echo str_replace('[ options ]', '[ options ] action', $OPTS->getUsageMessage());
	exit(1);
}

include dirname(__FILE__) . '/../bootstrap.inc.php';

// Allow loading of application module classes.
$autoloader = new OpenSKOS_Autoloader();
$mainAutoloader = Zend_Loader_Autoloader::getInstance();
$mainAutoloader->pushAutoloader($autoloader, array('Editor_', 'Api_'));


// Concepts
$concepts = [
'920cdc70-d7cf-780b-d65f-147261320e43',
'dd1c40bb-1136-0997-3033-d16fb1a125c1',
'3231d05c-4039-bd3b-17ac-62c13860ec5e',
'2e30af01-c05c-966a-2180-ddbaa78af8bb',
'5549fdc1-e6cc-477d-b379-f2dec99ca935',
'b55b949f-b791-ad34-783b-ce24d0da4d8a',
'644e5e4a-87c5-b0b3-8081-f6cf08764f56',
'c95ffbab-216c-0924-5817-28b5283ab7e6',
'01cc7a19-076b-ad08-95b0-6d9c5edc3c0b',
'818fa377-92bb-a1d5-1bd0-8a196bbc42a5',
'bb2a483c-9070-e67e-05d4-327d754d540c',
'4c98c237-b399-b9b9-9c17-c1436217621a',
'8839e213-0598-378b-ba4c-58c330a20ab3',
'fd84e035-7bbc-3547-586f-fbbdc30e9135',
'143c8189-3858-538f-7efb-220b46b5458f',
'6ba10071-3937-b8bb-c761-fec65686794d',
'19e9125b-5fb7-47cd-01a4-9ef61f7577d7',
'c2a8907d-8125-b25f-e7f9-9ecdc3345eb7',
'afc37167-dac2-0639-32ad-c44dc3189acc',
'734e9ba3-fe76-2dd7-8a86-a9d8c5f62049',
'433fc254-ffef-1ab9-c7da-3c859b51b912',
'5cdbc3e7-0c6c-d356-d622-d3335b06ff4a',
'ec48ed36-f03d-d545-7792-1278ef219e11',
'bb735fb6-d6c4-a347-e5f7-66a75e4a1561',
'e0ef96f4-fe6e-1840-ad9f-07c58a85197e',
'eb136bdc-39c4-a89a-2901-6b043e6d0d70',
'98c37fa0-124c-2ea4-ebdf-31a9f0b828d0',
'ea4a31e3-805d-22bc-5d23-c2dd7fa1bba2',
'3c7ba466-0b26-e4ab-37f2-41d285c988c0',
'3c610b3d-0594-667f-8d3f-97f5e082bc0e',
'706515c8-8532-5bb3-9158-5e4b67059683',
'8908056c-cf1d-3383-33a6-e779d8f393fb',
'73831ce6-4e0d-d9c6-6b58-3890646a47b1',
'8b236000-2ff7-e93e-1228-9a6cf9a9602b',
'57ef5031-f9e3-269e-fb36-82c8d1907b55',
'8590cb19-0ede-73e6-5cc8-6ca1a78e38d0',
'7dddfca5-cdcc-96d3-fcba-bb2af9eafe54',
'd37516b2-8fa4-d3b1-c386-308fada62792',
'02c767ab-84c1-ce33-e31e-bba0e97f9974',
'b7b9115e-e5c5-0322-a56b-315e2c1cb353',
'38804e09-c8f1-9637-ea62-328926c6ab34',
'3b2a0c8f-0c67-bfc3-4921-fe05557355c5',
'db579278-7b83-2edf-3320-c8da0d02f3e9',
'4203a039-37fd-2da6-60f5-8d79f1a77800',
'98fec248-90c5-3395-c192-afe69afc29ff',
'acd82ad7-dff3-8192-71f8-48e9ee6fffa3',
'b5d3f334-da94-f92f-03b4-8a2fbb27e2c5',
'dd0c61cd-1c0e-618f-0173-8706908a50da',
'8abf82e8-bdd7-c35a-c071-f1e4d596123b',
'487d9507-8269-622c-b623-54be092a084b',
'7e870aa5-130e-e1d6-85cb-35fd857e5a0d',
'7265fb05-8669-772b-9777-ad9dd15730db',
'0a7acb27-6a8a-78e8-398f-ec873278f3cb',
'dae20175-51fe-2df4-9043-d0dc3cd099e6',
'126dbe28-d9eb-ebbe-97a4-227c235f0c4a',
'dc339200-e0d8-a640-5222-4008647d3f33',
'beecf68e-35f3-a7bf-c164-e9f5336ef0c5',
'57cded6b-b63a-d65f-6652-05e148d8264a',
'd43bdfda-d78c-0f8f-8367-5ac0827f1857',
'c0d34ec0-0460-52e3-b461-69b5243652a1',
'2460e1ba-1289-e468-50e9-89fd08938037',
'3df659b6-a694-3342-92c3-54644c9c3e73',
'72d1c1ea-068a-f37e-3d79-da0e7a15e514',
'b87258d7-484c-b0e5-579f-08008c9ffb69',
'102badb2-6241-77b5-b710-5912f07b065a',
'b252a866-4d13-7faf-8c62-502f674ec89c',
'd4396783-9eb0-1f02-9aa2-6eb9e40ca5dd',
'1f941582-f745-12d5-a32e-8bd7fadd103f',
'c273bfa8-01be-7ac0-d9f7-84166f09dcd5',
'49af975e-86ae-5f92-01a3-c7f0ff4badeb',
'2e744fa0-4dc7-1611-c542-4c09c44a895d',
'0ba560d6-9e70-6b78-af3a-322a398a7afb',
'7b5aa74d-9c05-dc23-b475-35fd21e1ea59',
'a44dbdd2-4a00-24ba-9d9e-f594f5095ee3',
'f0ec1308-aac1-439d-66ca-53f6ac6dc90b',
'4091f43b-00af-6d87-50b8-14363abbb477',
'599c8729-036c-6971-bfe7-f4ea6269c77b',
'997ed3dc-7033-274e-f8e0-23a7c626d7b2',
'0044de5d-a7de-28dd-c8c9-68dec0d5939f',
'0b053788-b6cd-346b-07a2-9bbdd30f0fb3',
'8d8693cb-6dc3-e3de-9863-9b08b7099af7',
'41182a55-09f8-8ed0-b757-50cb123a8562',
'6e45b790-1176-fe18-1cdf-1c9c139ee11d',
'5ea8653b-4dbb-80eb-5272-2a68f3a06c6c',
'e01b6bbb-c7b9-b6ef-0751-826273c123aa',
'439ff6d0-ff08-dde4-5256-8bf2fb4d5c14',
'75ae2cee-38f8-f3f5-3ea3-5e9437f17736',
'5d357fe7-8dc1-63bb-ae29-07d7eafed974',
'daf5e9fc-7de3-b113-58b2-16d50fd4f6d2',
'f27ff161-5919-034d-8275-fa50863913f6',
'903f8d90-86a9-38fc-ebd0-5197eaef0095',
'4361f983-44c7-c68b-e85e-2b93159e3916',
'c11d1bc6-98f4-4da2-1aad-ca23a93f0b6d',
'c9403813-3d37-4e85-0672-9c14848169ce',
'064fcb05-c225-4878-757e-dee303977d03',
'1a11bb27-344c-d3ab-8802-59bd1ffc7e72',
'ef1175a8-2240-eb36-6f7c-110e7e52f791',
'9776f4cf-4f99-ee7f-3e1a-9e39a65dcd77',
'ed20de52-d318-fd5c-29c2-21e9ea1797dd',
'be5f8983-65df-200b-51de-7a435a9af465',
'ae6a8ca1-4e94-678e-b767-0d80dfbdd2ad',
'a4d2bfff-8b51-f7a5-37d4-7cc9383ed790',
'3e73d3bc-ada5-0851-75d7-503453709ec6',
'ea842ec9-48a4-e193-1a5c-b0ca43b14319',
'326d22ea-6e63-ebae-5eb2-27c74454270e',
'efd0e36d-05c2-96c5-39af-14203e15ac89',
'cfee5c99-3b0e-261d-cd5f-7a1498dda362',
'8cfa52e6-e80e-2200-c2a5-bbe59feed6ae',
'8dc4c0dc-ad7b-660c-6492-b10067c09059',
'0fbaf078-33a7-0c49-01c5-ba63399521f3',
'13d15fd3-95a9-65ea-412f-3f9471cd6d72',
'df4385f7-5fca-376a-5ba8-3ae9a5c7bdc0',
'b88216f7-55b5-de6a-3c2e-ff345bd08e88',
'14daee9e-68f8-1657-5f19-ed2aa544d0f5',
'30aa2cf3-c23e-2d4a-7c2b-a6ab851a362f',
'c0589b1a-5d42-e2d2-50c4-5709db9867cf',
'7342297b-d4f0-12e0-3e7d-2310c7563fba',
'e552edf2-848c-ba4f-e444-31e171d5765b',
'c5a62003-b324-f71d-7cdd-c514502784c4',
'd6d51082-82af-32b3-2933-96ef52df9913',
'e14b5927-3466-eb36-25ca-5a69d024004c',
'0c42f848-a8ef-801c-03b5-3f625a41203b',
'bb16be69-f512-4f6a-f2fc-9389a92bef65',
'294a8c9a-7aad-5268-8549-6499752423ae',
'35c65c98-2722-5818-929d-59762d482b11',
'841594db-d248-389f-6ceb-557e34eff873',
'82c5619b-d674-8338-f391-4c42c76ce10a',
'894c540d-3a99-d415-bb42-620cea245551',
'5de40ec1-9df8-04ca-9c58-436ba7698015',
'dd412cf0-7a76-b865-2349-fb28040124ea',
'902e6b22-620c-f425-acc5-3b948a035f09',
'6b4b41e6-934e-9aee-2dd7-9757d7be5532',
'e8b64f8f-dfa6-35b8-deeb-f7b92018fe69',
'adbefdb7-9631-5784-6b6f-e73f279f4847',
'b9eca174-9e8b-b002-70ec-87372bd1c30d',
'db9447c3-4411-79fa-db6f-c9973c303067',
'677e64ab-c1c7-bc58-30d6-36236fd35fb4',
'7e0a5e62-2e87-0ccb-563a-fd83a6853a06',
'66aa2a31-d6f7-a8d4-9699-28c330ddc708',
'38a62308-97a6-0197-12d0-aaaa397bbb0f',
'af9e48d0-53f5-e43d-3fd4-956b540d7bde',
'bc0e71d8-f444-3901-7c62-bd7e3fc0dd36',
'cf7fff8f-4797-171b-ca69-da7ae61f9158',
'441e4a5d-3bf0-0d34-3ab4-3204a6a10cfa',
'0d29e5ac-a549-24b6-001c-5431fc98e4ff',
'2783c409-02c5-9fac-94d3-3eb275627310',
'0e32ed46-f37b-3222-ca29-867a4fbc0213',
'10dde9cd-4e95-f5d0-1b68-c5bf594af98e',
'31028e24-67aa-95e0-1da6-590ad5b49ef2',
'beedcd86-aa74-d834-71fe-628acd24876d',
'8aa9bd0a-7bbb-09d5-91f8-04e6a13efb48',
'cb82c08e-8760-6416-3909-2119342e34ca',
'e0ae5329-14be-9365-5f82-0c7253bd73a9',
'74f70cc6-8d88-11dd-77a7-d5e218fd1d43',
'97f2140e-d802-bb26-c7b0-605b34b63ef2',
'5e7284e2-dff7-14db-c538-f968774bbc38',
'4c26a679-df7b-0a54-2094-de00815656ad',
'1047acf1-3071-7c0d-998b-dbd6424f22fb',
'918c2918-e84e-d42b-09e0-9cfd866a4801',
'e1c1dff9-a853-104c-c336-0ed99384902a',
'246b0d2b-9f2b-cbba-9b10-da6ce7e745a2',
'40d33698-cbac-6c2f-c98b-f3b3aab99708',
'0be22b6f-703c-5bcc-de96-0ead64d82059',
'8a11a215-b28b-1d7b-26ed-01ec4901cd50',
'ee59a50d-2b53-f0c1-86a4-c58f527e52b2',
'2b9e7c08-81ae-2859-508b-f531808e5b78',
'2aee4d2e-1f00-785c-19ec-4d93cc552d83',
'd842852a-cde9-7e6c-1904-4083f1534f21',
'ed92a7b5-ebd2-fbde-d943-94a6ddf32cb5',
'40d0b815-642b-4500-791b-549dfa13f1a8',
'9adc7746-5895-4d11-4519-493beb2aa3f4',
'53e29e8f-bf82-01ba-47f5-35e55a20d5f7',
'033fcfd3-d981-251e-d9d9-73f70e52d00a',
'586aeb81-ee8f-6614-d31d-36fd02a828e6',
'0a41cc9b-d21b-64e5-c956-864dc325a61f',
'e25de650-5ba0-d394-cae8-bb4ef53d2327',
'beb36bd6-fab4-ec5a-7fae-aea15a794f6e',
'906f19cb-f313-0448-23f2-0070d788761e',
'b4668ec1-24de-45ee-8106-ce33f0ea49f1',
'dc2315ad-6abd-ddf5-8a8a-00049401360d',
'5ca4ed3a-f6bb-762f-d0fb-491ca7760d21',
'6498d0ca-05bc-309a-28ba-6036c7e6f1c4',
'800dbe95-686b-8381-0caa-c436184296f4',
'f4b78bce-9e9e-1721-4b25-f0e68f563184',
'cab6496f-a145-1e2d-6e09-b592c2db3fb0',
'c9a71b58-37f8-4081-69d0-6a73baefa855',
'6ba00e6c-629e-903c-7dac-f793659fdf12',
'136008be-03fc-99c8-5f60-40bd3cabda71',
'9fa42159-33f4-d728-3aec-dfd6529adb11',
'54e63646-0dc4-25b9-c988-c78166c928d8',
'14777950-c40d-14c5-89ed-5f463e6fd57d',
'6c0820a8-97a8-5646-7af2-edff391492f4',
'8d79eb0e-648e-2dbc-7f14-f47a3faec261',
'8454733e-1e41-e4de-8fd5-aef37880ef45',
'b162cdb5-2e10-6817-58d2-905305912d90',
'eb9810a4-9420-48ee-5096-1036a53d4046',
'450e84d3-4a4b-ed8b-e754-32ad46bd3311',
'372bbb48-6f0e-cb90-8542-7008c8b4d40a',
'6d6a3ebd-81e3-4f55-879a-4b4afaa958a9',
'20ccbac4-f075-852c-8750-67d25298abe5',
'1650d9ef-c4d2-cca2-7c49-3b57bd28bada',
'1321e83d-6901-7b57-b9ba-0e56cf405fab',
'a96a0b9a-13ab-6895-510f-e3a9c5e3fb29',
'54acf154-74c8-9da7-5419-2028dbe1d980',
'a138818d-39e1-7c9b-6c9c-3d62c4adfe39',
'1c6ca48f-bd09-c90a-6dde-a7fde55ea966',
'b6602e8f-dfef-fa4a-47be-2a255ceb80da',
'ab10e286-1022-7c53-7c79-4903c86c2119',
'd0af8a23-f460-c768-2591-dcc759c7ff23',
'1b9db8dc-8c3c-ab8e-271b-efa8c471931a',
'9ce26abb-e320-4bce-4330-9d3611446094',
'dd914d8e-d174-193b-0125-dd6caaa4ee8b',
'6f725205-a23a-b41a-9c7b-bbbf7f3797c3',
'14fca40f-6deb-b21c-59f6-38dfb04331b7',
'83ad31d6-bde3-734c-2e81-61540bef4ed7',
'0ae89840-279d-9a0b-0d2b-5c0878ead406',
'f059e6e8-69f5-9678-4d2a-2790c5e13e61',
'1373e66c-64dc-0814-a82d-02923328cacb',
'70ba0a13-89d7-0ed9-c0e7-a73f58c6caca',
'be5c2638-40af-d2a9-195b-366150c941e8',
'061f43e9-97eb-49f5-349b-5d0f42eaac02',
'd17bd495-c5f8-0898-0929-b577fe475179',
'8704381b-285f-01e6-3cbe-dc34bdfc6fc7',
'fe87128e-7333-4799-b8ff-08f6dedf4a5b',
'e8a2dcd4-ebe0-87f0-8fac-1b33f92a2084',
'fa96a816-68ea-5f52-94a0-9f8d05f789e6',
'a8dc972a-93ca-4f25-8bd9-93c3c6daae84',
'3e496126-24da-9287-d005-3cebe4ea9089',
'94ff8b26-2af0-a3f4-bf22-3b38ddb4f78e',
'4fd5d430-d9ca-27f7-37da-5b961fae9b02',
'790f6b8d-1128-ec70-2ca6-dfec274a4e5f',
'1078c74a-4b27-84d7-b5b0-b7996dc4c355',
'870fc915-0932-c2ec-8d7f-649f3f6bfb9c',
'74f2e068-891c-166e-ec4f-3bd1167d3875',
'a3727d3b-d190-873a-490e-8af956d69361',
'af24eaa7-8b86-4efd-7032-d01fb61b1c58',
'52d8d596-4561-4ee7-e349-5fb9b5169340',
'459dbcb6-d541-4081-4251-386de7240727',
'96d84d00-8baa-e355-00f4-58f3e46093cb',
'46ed6543-6da7-0f41-2490-0364c6473dc4',
'2aeb8959-79eb-ce28-94e7-3d09166c752e',
'c416dae4-0f1a-d276-de2e-0c7415396129',
'6b952f31-1d31-77f8-3c5b-2176bb6266f8',
'03132289-ea15-a025-008d-d231bd4d813e',
'a0836d16-6809-3cbc-3836-366a564cb174',
'61fc93c9-ba60-41e6-f9d9-4a5acc96f7ed',
'e8da9c47-2418-c07f-605d-2f26ce67f401',
'e747b616-ee90-45fb-9fb9-97fee605494c',
'776b1777-d56d-5aab-fa40-203a56a53b74',
'e3a5bbe0-79b1-4294-5c30-c6a2301d07cf',
'5a883350-75da-3752-9eab-b0ee6aa53f44',
'7b7ed256-1d18-4328-0a25-11fff35bd0d0',
'cc5c4f11-f869-74f5-be5b-9bdcbafe9132',
'bce3ac06-468d-f8d7-ec5b-106773c9ae33',
'838da3fd-c693-3b4b-e9d6-c73c70a4fedc',
'd3322da0-db58-6663-3ec6-97176c65e862',
'657c16e3-e9dd-e6b2-f8da-a86965b88ba3',
'e12bd7da-0836-3da3-5179-c45d523eddd2',
'ae45fd90-8341-0b44-2f2e-b2ba4953d40e',
'04f58162-7547-d5e6-423f-b35aaa0acf03',
'6ee2f621-0d2e-82d0-bc74-bc1dec99f198',
'e9b76692-c503-f48e-696c-e1beea7824eb',
'd455f446-2648-f092-ca81-26118a8d1cc3',
'13169613-0600-a788-338c-769b3c2ceec7',
'60dc56e4-b926-201d-5a96-7622ce3d6ee6',
'216420d5-e4a2-a044-9c0b-7c745a77aad3',
'bfb06ff7-d8ae-e045-bf0e-b87b19ba22bf',
'94f62fff-941c-353c-f0f1-b234242f5cb3',
'b8736bf1-9449-5495-3adb-b0444b52cb9f',
'2c5fa0d8-911d-046f-ca2b-bcee11c66c82',
'5d43b765-3f53-516a-2cc3-8e6a87a6c556',
'105d15b7-eaa8-5e1c-9a76-902f23bb44c8',
'a05d5b8d-2f62-33a8-7723-4558727009d6',
'411c7588-1985-0439-918b-d91590afe158',
'bb1c545a-1331-3ab9-2427-cd31f38b809e',
'8a07025a-415f-434a-e6fa-5b963ce31fc5',
'549c6301-7211-3581-8564-1bb6e0e9f57e',
'87bf2610-d7f2-0e02-e354-84efff052fc8',
'31789927-a87c-81cd-0b70-78e4b59bb8af',
'e96009a4-9852-c265-fb80-eacec394be62',
'4b7f4f4d-8982-31dd-43a4-60643df71366',
'f7115a21-1382-c5c7-4f91-4daa51f0ccd6',
'debd6566-bea0-7861-cb2e-59d4f8fc3a1e',
'2a32ac5b-41f6-6e0f-c210-2ef1d07915e9',
'056cefb6-d66b-c3d8-4f81-713e9b0a714c',
'fdc701bf-2e8c-93a3-b0d1-54c0413e1695',
'583b8dc6-3348-c5b1-79ca-4e4e31016214',
'63b0a88a-2195-cf7d-e46a-0a5c6aa15367',
'95cde40c-cc65-72c6-f927-f7be8006f72a',
'5d0e0654-9478-9bac-3de7-60673cd84fc0',
'c9a97e6e-5172-9619-c98a-29a4cc55fc1d',
'616bcf23-9aaa-abc0-a774-061003347f26',
'6f9d14b7-5549-d261-2c05-83de75b65968',
'6331f9b5-c1ce-cc5c-153f-5812c7152c05',
'20b4098e-682c-b69d-a122-bedc1f0ca4f6',
'0dd081b9-50d1-251b-9d97-ebb98e12c2fa',
'd1967d17-acae-4155-32f7-60e69ecdd6e5',
'a0250a1a-4d63-fc7d-9119-33ff57969813',
'8d9ff5d9-04ca-5195-50db-2fcfd1543ba2',
'5d9e6397-ea78-a750-7bea-e3cfe70e05ff',
'6afe716c-d7be-a157-8e7c-c5e880bce76f',
'58b490bf-f62f-8bc1-87d1-7b13681e123e',
'72f2ef5d-dad8-1e8c-1662-34445dc2c3d7',
'd687fbb7-f973-1f54-588a-c4aed77199e1',
'6a7fdecc-e6e6-c69b-737c-4b218497a4e0',
'6083c2d0-ca38-47e6-d7c4-8397b1736b67',
'63565bbf-0032-1396-33a0-ba3af1901b94',
'6ca5bdd5-b811-80b0-080d-c5a41e714a28',
'28a96496-6d9c-c685-6a07-2422f1991854',
'8a976b25-42a2-13dc-247c-86775b3c5ed6',
'4939cfc4-a2b7-839a-36f0-7f7328ee081d',
'c384209d-c1ad-2f48-64ef-8ec46cf45197',
'e67f29bf-47df-4bcc-f5e1-c819294471b8',
'645f2f59-2431-93d4-ec0b-8c751dd3068f',
'678baff5-87bd-7f29-f692-cc2c93c0f9b3',
'c2de143a-8a37-3c1a-feee-76dd71550ff0',
'a760d709-58ab-5d77-0395-c61e21724b8b',
'fded7d71-9c25-b141-6140-ce1134ce420b',
'f6657283-18f2-b769-b9cc-7716976e4fe0',
'39daa7fd-1f99-beac-fd6a-a4bf85c98fa1',
'ed5a1809-e0cc-ce5f-00bf-2808cad099fc',
'bb11f081-b206-3471-59cd-525aec9c0e74',
'a682276f-7a7f-86aa-4873-d5b1f3891b6b',
'4cbad371-13bc-7aa5-d91e-86e71db78058',
'47cb3fc6-0626-2f87-74b8-5d5b9341d9b9',
'0f929b70-4907-ebd8-0b62-3177f956287e',
'ebe46354-1ea3-7a82-7f88-35fa9fb9bcc5',
'fc19b625-5245-56c1-b433-3e0cec665b53',
'535aba28-5c74-2450-96e8-2ab937364b6e',
'913daae0-6cde-8124-4f19-05cb4bd81439',
'484f6d11-e3e3-07ef-ec98-d860785a8774',
'83634b5a-b47b-500f-f749-243acd0453d9',
'57acaca2-6cdf-6ef0-2b03-6c7b2c94815c',
'1e549388-979a-d5b3-b1ef-3c050893474b',
'f1376875-77c6-750a-e9ed-d4a929423b80',
'347530b1-473c-6b61-81bb-0a8316a8d84b',
'c0877594-971a-90c6-b60c-45da2ac21666',
'227f2233-feb5-3424-5ad8-ff024b766742',
'76580ee8-0bf4-5197-3a20-41161f7e75aa',
'223b556d-6e85-994c-df2f-34c6b9af4590',
'1cb9a920-cd3c-be18-455d-6291b76e696e',
'bdc20d12-e273-8d73-2f2a-85954fd1c1da',
'e5470c92-b81d-88d4-e310-1b1b84eb46be',
'dc58baf2-b169-ab71-f131-f91d081e4d74',
'5cf1ac56-1fed-c57a-9f2a-3677d84d6064',
'87bc7a15-65af-93c8-eb39-d35c75d72444',
'f2e02aa6-c675-55f0-dbf8-3d82d69b6b6b',
'ea52d433-b309-0f6a-f2e0-1ab2d3e19b0c',
'd699a2bb-74e9-1daf-b7ee-8c2c57105ca8',
'dd6227c1-b0d2-5119-47bf-d7c8d0f340c6',
'7c90c434-e2c9-4b81-34e0-33ca651250e0',
'a867bd10-220c-8c96-cd5e-4f96b7ae7a39',
'8c656595-15ab-27d9-af78-6fba84e40ec8',
'0d33501d-ad16-97ac-a3ab-8d0e7ef7d869',
'be6274b0-20d0-4b24-21d4-e48e1169ebc3',
'aa4c39ac-adc1-75fa-7b69-90d3b88588ce',
'83fd4313-3a52-a55c-41d1-dd036c2f6fd7',
'd76b7139-2d35-2912-b3e5-81934dbac1bf',
'6083630e-acca-7af4-b299-4084855d978c',
'b3270152-14db-da7a-5f7e-c812be0e660c',
'e9a6e698-02d5-ff20-49b5-eda5dd50ae87',
'e8804b94-aa2b-5227-3367-76138160aa3f',
'ec67f4a3-d411-42ec-de64-d5122b4195a3',
'9f407cc6-a3a9-4500-58f6-17539128e59d',
'a74c2046-9f66-8986-4da6-68522e624912',
'0a66a7de-2f73-dc45-1280-1289f11f8f5c',
'99275654-f292-9a67-137b-3ea4418d68f8',
'8f436cc6-30ba-f8e3-cd97-a86bda541a10',
'6e6a63b2-93ed-c4be-0fe0-fa64a3472f06',
'fab8a291-8c19-cc2c-d13a-a8eb90e6683f',
'6ab4f43a-0be7-74b7-7d08-5668598ee0c1',
'bd5fc8c6-0b68-8c14-e7d4-e13fa50a42fd',
'0d7ea9fa-99e9-444a-de20-52c4baade3e9',
'6d9f0bc6-fed9-0d89-cabf-a916ef86ab8b',
'f3d7fdbb-b780-84f6-c219-f8a65cd5cbf1',
'a7136cff-a0a5-e3f1-f1da-c1b459cf8c47',
'4e63cd78-c98f-2a7d-3caa-5367bb2770a1',
'1f5fa209-4752-28f9-eaaf-6bed29e35696',
'd8a4f6a3-c9cd-1bb7-103a-326c6421f25c',
'56443486-a171-bd9d-30e8-05ea507b0495',
'80f387ef-5e55-681e-b548-84c8f16ecd02',
'c3d398a3-6cfd-74cc-77b9-35cfd10078a0',
'84152c5d-c283-35e9-5e61-30fb13cc77b3',
'7c8fc8e6-8781-e00a-dc3d-ad28a81bd92a',
'e80b8529-6fc4-ec00-d99c-ffb6299a7448',
'aa38e3e8-82b7-25b8-9fa5-f7397b777e86',
'bba2e575-ba86-6ae8-3680-a4960f432e5e',
'9888aef4-d4d3-e674-4b6f-a76602851a73',
'8330c6f2-5299-e458-e804-01cf2265faf0',
'79df49a3-b6f8-9305-4bca-2d2968928324',
'f128aacc-e1e2-a281-caf8-49471ef08b8d',
'5ef597be-d7f5-62ec-d763-3f019e446bc9',
'd5a861a9-6563-5d9b-9258-f876baa14cff',
'2ffc44b8-9544-9960-6436-e3bcd5203514',
'9fbf05af-d4ec-19ab-839a-788d179e555f',
'0892ab2b-b7a1-bc24-ae60-1de261133ac3',
'c317f79e-513d-1b28-27d9-c75e91e6947a',
'c8d54252-b817-18bf-e7a0-476f186f4183',
'dce98ebd-1a5f-7179-55f2-60fd0686ed48',
'ca4de68c-af07-c6f9-9d71-170081816acc',
'7816b96d-212f-e4f5-3b87-7088bafa3433',
'8495c26f-488e-4614-5acd-f87cfeb60f4f',
'0ca9cd94-8dd2-1659-24db-740d8f2ddacf',
'7c8a326d-14fe-9ab9-4de4-8359e4f156f2',
'c8b1a83f-7987-7e85-8fdd-c2624b7eeb3d',
'a390e629-1d4c-6764-70f2-803897df05bf',
'620a8a87-9947-5ab4-cd1f-107719837248',
'e59a3864-a9f6-288c-7489-b3d8a73b7b99',
'079ec6ea-bc21-3735-c462-5a42cfc66b19',
'24ff9fef-764b-e84d-4a0b-98b78c78f0e8',
'a4bbbd0e-7f2b-7f2a-b122-0f431b6c40db',
'96d74a1e-6568-5837-b1db-4d94bc2a09de',
'69efb287-9abf-2d07-4545-ca70c9c82b99',
'32c1bf7e-2be7-0322-49b7-51765d43ae69',
'baa191e8-6fd7-1bd4-55cc-e4c28e9881f8',
'abd11851-96af-a49c-c97e-0a7a920a8ef9',
'142290ab-66b2-9951-410d-74b1025db821',
'e85d6321-6387-04ca-931f-f10681a27217',
'96888907-dcb9-5f3d-62e4-a6bd02135793',
'b65ca0ec-b9b1-5f41-f40a-9b041deca998',
'759c616d-ca30-330e-12fb-1e821ddaec6e',
'0e66c317-bd9b-1bad-7966-fac38b55b3df',
'c913ff4e-bef7-6f22-65a2-1b80863f24af',
'7d115a74-4684-dd72-9131-d57c73e1686d',
'5a23a1b7-b45f-44ee-bb73-e7b61096f8cd',
'618e3d82-8060-a575-448e-6c65ed0de13c',
'6f43bc88-4d0c-ccf7-3479-826b0754c40c',
'475742af-b28e-ec51-31ad-47b8963d9561',
'6d41208b-b7a1-c099-301f-412cdd242796',
'0c5d9bf3-4f25-c5b3-7890-3731812c377a',
'476f7e2e-bd7d-b1e4-7c1d-b8b8549fde9f',
'a75fa96a-39a3-1990-97d8-46f8e422b1ab',
'330f5bd9-6e25-9f52-89ac-35de81d769fe',
'fce8c139-f33c-7816-4a5b-0954c83eb8bf',
'9a4e6a51-be23-9c25-8776-23e61ff924b9',
'7dc3c31d-4ce6-56ab-ea68-edca5ec4fef6',
'2dc795a7-f91a-08e6-4887-669291ac61c5',
'fdf1091d-30ba-82f2-0912-db23b7c9230c',
'846ca644-da77-ab50-cad2-ec94273e9a65',
'e73f45f5-bf7d-ac57-8153-d9c7fd6550b1',
'ba01b936-a5c2-6f58-6bea-a440e81a6384',
'6efb1e92-c91c-ac6c-c039-e14aa2486be3',
'edabeebf-2895-7d59-2ba3-fa999c9ce425',
'c3cafca3-eef1-e835-b86c-b8fcbd2bda95',
'4209636d-86fe-814a-7746-f1af3a5dea18',
'3b8a6f92-43dd-b7bd-b860-f09e042eeb26',
'3d7f7459-d387-d058-1647-cbfc642b6544',
'4fb3c8ee-a26b-be7b-ce74-0610bd24bc80',
'b6123221-bf6b-b82e-c1e6-415c57b8fa86',
'6a085f78-1fc9-17ff-cf73-5cc057d432ed',
'7f8016b2-35cd-f6f8-4476-0309350ecb33',
'7bd78b80-3d5a-cd1f-4e47-68f3f843f824',
'52641a2c-49f4-d432-b244-c7276ec447cf',
'f91df1c7-d7d9-85f6-8bcc-eebe9bf49753',
'5b72ec9d-4b18-ea83-b43f-e8122beb9858',
'44925c1f-0291-f316-5c5e-a4d2ab86ec44',
'84e655fd-b526-0b8e-4d76-ff44d61c7f2a',
'ac7d906d-7e07-fa71-ef3e-4c4007f24353',
'f02cf6e9-9f3d-25eb-c057-6442ec2d4438',
'8a2a8d5a-4bb0-60e6-06a1-85c1f5c18f9e',
'df6cbda9-0135-be83-cb67-70dad97678a5',
'2b837f57-9bc2-8eae-5716-f9aa0a1c5126',
'99141516-f952-d8b6-250e-d6671c40add1',
'e1bd6323-d64d-e2b8-b1ca-72b97b112fc0',
'e9e71749-f94d-f9c5-a6a7-9372d369bac1',
'c6c3afca-e254-019d-875e-fc0adcf97414',
'53083a57-ccc8-3ff5-961d-885632646df0',
'd4efd31b-4e85-1093-1416-c121cb153b8d',
'b3d90a9e-7d87-c80f-6eec-c198d795d487',
'e0843c43-3d7d-ece4-7d20-aa29e7e21295',
'1d4637ef-6244-71ed-dbc9-10ea476474f2',
'2ae6e3b0-4858-fc43-d62a-b6dc41bbfc55',
'cd6a3714-c093-c1f8-baf0-e255f4469ca9',
'53083a0e-ddbd-c968-8dc8-47090153fe71',
'4dd434a5-b4b4-8537-9baa-41c83dd7c20c',
'2e8b476f-47c6-de81-2cbc-81671209f67a',
'c21f2e0b-72ab-794b-4494-6f07825d65fc',
'34767927-6d8e-855a-358c-95e6c65342d3',
'2079fd85-746c-63a0-b997-f160da5e3b3f',
'327216d2-2459-b828-680c-071d323801f9',
'21c746db-e7b1-126b-f876-3fc2525bc5a2',
'9471509e-5971-9dfb-319e-3ea9bba3035d',
'74a9bbfd-7dc0-2119-9759-d4e12a1f4e99',
'09bce8f6-8316-40cc-4003-e9bf1ad9f5a7',
'63524818-8d98-bd72-62fa-8e98e091f948',
'0e24de0c-c15a-7d84-a7b0-ccc2a7bbadac',
'8d33f560-d749-64c7-9ea3-89ee0e2fca51',
'a76cda05-04b0-e5a1-2884-57a09e65c8f4',
'd22fc49e-48f4-bff6-bb45-58c968a4abee',
'f6e05a60-c772-8538-c64a-e61b3cd26128',
'c3454ea0-b7a1-f5dc-0506-fc14f24e6b1a',
'38d0f08c-b5b8-c1f6-95c5-631e5c9be204',
'aaa62d2a-6df8-ce5b-de85-5dad91dd3c4e',
'b014fd9b-369f-06c4-9214-46502a0070ff',
'8e9f8307-16d7-9bf1-e7de-8a923376a3c0',
'cdff6e3c-f236-3163-516b-da981a703483',
'300bc078-3a2f-8c63-7dc2-7d1b4c61eadd',
'893ce11f-1e38-7bb9-cc11-fdd783da2178',
'e8409fc1-169c-9be0-eff0-b8a7309f85c5',
'f68622dc-92ca-082f-be92-ca3d14e8d062',
'e270ca9f-b065-4fe7-9cb8-448714aa2de1',
'00755f7c-bba0-32d9-751c-4c267e40d51b',
'd2e3f3e7-59c8-ba22-f4e9-0b0800302e8f',
'f8e48059-5d78-1521-d42c-b98fd5a8b694',
'87c1e8be-cc64-6704-b206-ed624b238d67',
'a1b82728-4839-8004-4dfd-c13965f3693b',
'0d891216-d4c5-cbf4-cf3d-9b1f60ffd55d',
'0765ca3d-1c78-b4d6-e198-71aa6e81de61',
'5930066c-f10e-1706-61b9-79e67e424340',
'bad8b303-9e31-b332-cedb-c80118f0dc12',
'9e301ea1-4634-45f7-6888-fd7efdffb04c',
'a076b70b-a56c-c3f3-c840-21b419ac8766',
'be2f0d3a-94f0-99fb-c674-2d60cac515e9',
'0de268eb-c4a2-58db-bebd-2b0f7a071e2a',
'1133eba0-0783-f124-3ee2-7bd2bc132708',
'5d869fc4-ed57-90b8-22bf-04d882d7ac51',
'3ef1ba60-2699-9df2-e19a-e64e832d0ac2',
'70875738-329b-25d0-646b-aa767d10a401',
'33d2dc06-3b0f-3e8f-f49e-bd320e31d049',
'0324f7db-8164-c713-efdc-6a8b40f5f24d',
'506d3fab-3980-6b2f-90c9-51480b009d0e',
'a2aa4a9e-a62c-1e96-0f7e-1b8c6f49fd47',
'b491c2e7-6cab-3d86-3c0b-d430adf264de',
'97a5ea29-1247-d176-c93c-e3139ca3cfb1',
'c0940b4b-3e2c-dc45-5344-de3d3e889408',
'6950111a-badd-83af-7ef9-46c640755497',
'0cb8a0d9-5510-3b2e-2217-284d38a5e478',
'2ecf37c9-b5d8-a3ba-bf5c-c0daa096cecf',
'c0425315-46e1-497f-2f58-655a085c41a6',
'f15b7122-7580-d826-0bf7-893524a211db',
'3beb2776-7a89-808c-9eda-8279788f974f',
'5ab4a8f3-28e9-d0b2-80f0-a6d1ed8d17c9',
'41f52386-d9fe-234c-9150-cb5cb0a6dc71',
'a358dfdf-730b-e8b8-98a2-7096c5a7cf93',
'6acedf0a-4234-222b-2538-638d2310f5cc',
'fcaf672b-603c-0f85-581e-322f7eea266c',
'6dc3a25b-4328-f22f-87dd-5c750bf02dc9',
'4d624abc-3d13-efb5-615a-6a8cc0089512',
'4716a841-98fe-e756-0ecd-6e64f6a51e85',
'92c7330f-8075-991e-05e5-3f29dd755021',
'f76a47de-cc2b-06cc-a55e-015c6c3da3ec',
'5e7b4af0-d9e2-c526-cb2a-af8e63136487',
'28070558-3809-3ad7-fa3a-4f96aad4f219',
'1bc29efa-e8ee-11fc-dc3d-03c289d1af65',
'0bd44ae1-04cf-1cdd-6eb8-a02df31432a6',
'08153d46-204b-b3c9-17d2-e1ed9f2075be',
'7a919e2b-4242-a13e-c217-8a3455c609f2',
'06d0eadf-99b2-3a41-cac6-85c1738ad104',
'27786651-9350-7c61-5ca5-17bed59bd084',
'98497834-022c-cda4-2ab8-b3d4a4555fb5',
'0c603d48-ab65-96d2-8c71-074bd248b263',
'8a0cee3c-dda3-6f9f-f924-d8c6453ee7f4',
'6757b0ba-f6b0-40b2-a834-5ec36cd6df0e',
];

$model = Api_Models_Concepts::factory();

$conceptsCounter = 0;
foreach ($concepts as $conceptUuid) {
    $conceptApi = $model->getConcept($conceptUuid);
    if ($conceptApi !== null) {
        echo $conceptUuid . PHP_EOL;
        $concept = new Editor_Models_Concept($conceptApi);
        $concept->update([], ['status' => OpenSKOS_Concept_Status::OBSOLETE], true, true);
        $conceptsCounter ++;
    } else {
        echo 'not found: ' . $conceptUuid . PHP_EOL;
    }
}

echo $conceptsCounter . ' concepts were made obsolete.' . "\n";