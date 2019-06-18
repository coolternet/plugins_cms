<?php

namespace Plugins;

use App; 

// Prise en charge de la fonction DB pour les bases de données
use Db; 

// Le nom de la class doit être le meme nom que le dossier mais n'est pas sensible à la case
class eshop extends \Plugins
{
	const AUTHOR 		= 'Yan Bourgeois'; // Votre nom
	const NAME 			= 'eSH0P'; // Nom du plugin
	const DESCRIPTION 	= 'E-Commerce management for Evo-CMS with Paypal'; // Bref description
	const VERSION 		= '0.1'; // Version de votre plugin

    protected static $plugin_id;
    protected static $plugin_dir;

	// Permet d'ajouter des paramètres de configuration par l'administration utilisable pour le plugin
	protected static $settings = array(
		'name' => array('type' => 'text',  'label' => "Merchant's name"),
        'id' => array('type' => 'text',  'label' => 'Paypal ID'),
		'secret' => array('type' => 'password',  'label' => 'Access Token'),
        'confirm' => array('type' => 'text',  'label' => 'Confirm URL'),
        'cancel' => array('type' => 'text',  'label' => 'Canceled URL'),
        'methode' => array('type' => 'select',  'label' => 'Méthode', 'choices' => ['Sandbox','Production']),
	);

	// Ajouté une permission au CMS
	protected static $permissions = [
	    'admin_currency'            => "Changer la devise principale",
	    'admin_invoice_create'      => "Créer des factures",
	    'admin_invoice_statement'   => "Changer l\'état d\'une factures",
	    'admin_invoice_delete'      => "Supprimer une facture",
	    'admin_customer_edit'       => 'Changer les informations des clients',
	    'customer_currency'         => 'Changer leur devise personelle',
	];

	public static function init()
	{
	    
        parent::route('/cart', function($params) {
            return __DIR__ . '/cart.php';
        });
	    
		// Permet de modifier l'initialisation du plugin lorsque celui-ci est fonctionnel
		require __DIR__  .'/lib/PayPal-PHP-SDK/autoload.php';
		require __DIR__ .'/pages_admin/core/functions.php';
		
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                Site('plugins.eshop.id'),     // ClientID
                Site('plugins.eshop.secret')  // ClientSecret
            )
        );

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(Site('plugins.eshop.confirm'))
			->setCancelUrl(Site('plugins.eshop.cancel'));

	}


	public static function activate()
	{
		global $user_session;
		$ipaddr = $_SERVER['REMOTE_ADDR'];

		\DB::CreateTable('eshop_settings', [
			'id'        			    => 'increment',
			'shop_name'		            => array('string', Site('name')),
			'shop_contractor'           => array('string', NULL),
			'shop_address'		        => array('string', NULL),
			'shop_city'		            => array('string', NULL),
			'shop_zip'		            => array('string', NULL),
			'shop_state'		        => array('string', NULL),
			'shop_country'		        => array('string', NULL),
			'shop_phone'		        => array('string', NULL),
			'shop_business_mail'        => array('string', Site('email')),
			'shop_vat'                  => array('string', NULL),
			'shop_currency_default'     => array('string', 'CAD'),
			'shop_currency_provider'    => array('int', '2'),
			'shop_currency_format'      => array('string', 'json'),
			'shop_currency_last_update' => array('date', NULL)
		], false, true);

		\DB::CreateTable('eshop_invoices', [
			'id'			=> 'increment',
			'uid'			=> 'integer', // {users.id}
			'state'			=> 'integer', // 0 Unpaid - 1 Paid - 2 canceled - 3 refund
			'create_date'	=> 'date',
			'due_date'		=> array('date', NULL),
			'pay_date'		=> array('datetime', NULL)
		], false, true);

		\DB::CreateTable('eshop_invoices_items', [
			'id'			=> 'increment',
			'inv_id'		=> 'integer', // {invoices.id}
			'item_id'		=> 'integer', // {products.id}
			'item_qty'		=> 'integer',
			'item_price'	=> 'float'
		], false, true);
		
		\DB::CreateTable('eshop_products', [
			'pid'		        	=> 'increment',
			'cid'          			=> 'integer',
			'associated_pid'		=> array('integer', NULL),
			'short_description'		=> array('string', NULL),
			'description'           => array('string', NULL),
			'sell_price'	     	=> 'float',
			'shipping_fees'        	=> array('integer', '1'),
			'cost_price'        	=> 'float',
			'taxes_apply'			=> array('integer', '1'),
			'availability_qty'		=> array('integer', '0'),
			'availability_low'		=> array('integer', '0'),
			'send_mail_qty_low'		=> array('integer', '0'),
			'availability_date'		=> 'date',
			'width'					=> array('integer', '0'),
			'height'				=> array('integer', '0'),
			'depth'					=> array('integer', '0'),
			'weight'				=> array('integer', '0'),
			'pictures'				=> array('string', NULL),
			'options'				=> array('string', NULL),
			'available'				=> array('integer', '1')
		], false, true);
		
		\DB::CreateTable('eshop_products_categories', [
			'id'			=> 'increment',
			'slug_name'	    => 'string',
			'available'		=> array('integer', '1')
		], false, true);
		
		\DB::CreateTable('eshop_products_sub_categories', [
			'id'			=> 'increment',
			'slug_name'	    => 'string',
			'available'		=> array('integer', '1')
		], false, true);
		
		\DB::CreateTable('eshop_products_company', [
			'id'			=> 'increment',
			'slug_name'	    => 'string',
			'logo'			=> array('string', NULL)
		], false, true);

		\DB::CreateTable('eshop_customers', [
			'uid'			=> 'integer', // {users.id}
			'first_name'	=> array('string', NULL),
			'last_name'		=> array('string', NULL),
			'address'      	=> array('string', NULL),
			'apt'			=> array('string', NULL),
            'city'          => array('string', NULL),
            'state'         => array('string', NULL),
            'zip'           => array('string', NULL),
			'phone'       	=> array('string', NULL),
			'currency'     	=> 'string',
            'deposite'		=> 'float'
		], false, true);

		\DB::CreateTable('eshop_log', [
			'id'			=> 'increment',
			'uid'			=> 'integer',
			'date_created'	=> 'timestamp',
			'ip'			=> 'string',
			'event'			=> 'string'
		], false, true);

		\DB::CreateTable('eshop_discounts', [
			'id'			=> 'increment',
			'pid'			=> 'integer',
			'pourcent'		=> 'integer',
			'start'			=> 'date',
			'end'			=> 'date',
			'nbr_used'		=> array('integer', NULL)
		], false, true);

		\DB::CreateTable('eshop_customers_discount', [
			'id'			=> 'increment',
			'discount_id'	=> 'integer',
			'date_used'		=> 'date'
		], false, true);

		\DB::CreateTable('eshop_deposite', [
			'id'			=> 'increment',
			'uid'			=> 'integer',
			'amount'		=> 'integer',
			'indate'		=> 'timestamp',
			'id_inv_ppal'	=> 'string'
		], false, true);
		
		\DB::CreateTable('eshop_currency', [
			'code'			=> 'string',
			'rate'  		=> 'float'
		], false, true);
		
		\DB::CreateTable('eshop_taxes', [
			'id'			=> 'increment',
			'name'			=> 'string',
			'code'			=> 'string',
			'rate'  		=> 'float',
			'tnumber'		=> 'string'
		], false, true);
		
		\DB::CreateTable('eshop_carriers', [
			'id'			=> 'increment',
			'name'			=> 'string',
		], false, true);
		
		\DB::CreateTable('eshop_currency_provider', [
			'provider_id'	=> 'integer',
			'name'  		=> 'string'
		], false, true);
		
		\DB::Insert('eshop_settings', [
			'id'        			=> '1',
			'shop_name'		        => Site('name'),
			'shop_contractor'       => 'Michel Côté',
			'shop_address'		    => '1 Place De La Concorde',
			'shop_city'		        => 'Laval',
			'shop_zip'		        => 'H7V-1B1',
			'shop_state'		    => 'Québec',
			'shop_country'		    => 'Canada',
			'shop_phone'		    => '124-134-3345',
			'shop_business_mail'    => Site('email'),
			'shop_vat'              => '217451424-5587',
			'shop_currency_default' => 'CAD',
			'shop_currency_provider'=> '2',
			'shop_currency_format'  => 'json'
		]);

		\DB::Insert('eshop_currency_provider', [
				'provider_id'   => '2',
				'name'          => 'European Central Bank'
		]);

		\DB::Insert('eshop_log', [
				'id'			=>	'1',
				'uid'			=>	$user_session['id'],
				'date_created'	=>	date("Y-m-d H:i:s"),
				'ip'			=>	$_SERVER['REMOTE_ADDR'],
				'event'			=>	'Installation du plugin E-SH0P'
		]);

		App::setNotice("Mon plugin est chargé !");

	}


	public static function deactivate()
	{
		// Exécuté des fonctions lors de la désactivation du plugin
		// Facultatif car de base c'est intégré au CMS : Le plugin {name} est maintenant désactivé

		\DB::DropTable('eshop_settings');
		\DB::DropTable('eshop_invoices');
		\DB::DropTable('eshop_invoices_items');
		\DB::DropTable('eshop_products');
		\DB::DropTable('eshop_products_sub_categories');
		\DB::DropTable('eshop_products_categories');
		\DB::DropTable('eshop_products_company');
		\DB::DropTable('eshop_customers');
		\DB::DropTable('eshop_customers_discount');
		\DB::DropTable('eshop_log');
		\DB::DropTable('eshop_discounts');
		\DB::DropTable('eshop_deposite');
		\DB::DropTable('eshop_currency');
		\DB::DropTable('eshop_currency_provider');
		\DB::DropTable('eshop_taxes');
		\DB::DropTable('eshop_carriers');

		App::setNotice("Mon plugin est déchargé et désactivé");
	}


	public static function hook_ajax($action)
	{
		// Ajouté un action pouvant être appelé par un script ajax
	}

	public static function hook_head()
	{
		// Exécuté durant la génération du contenu <head> à injecter <style> ou <script>
	}


	public static function hook_footer()
	{
		// Exécuté lors de la génération du pied de page, vers la toute fin du document
	}


	public static function hook_user_menu(&$items)
	{
		// Ajouté au menu contextuel de l'utilisateur d'autres items.
		// $items est un array de [label, fa-icon, link]
	}


	public static function hook_admin_menu(&$items)
	{
		// Ajouté au menu latéral de l'administration
		// $items est un array de [label, fa-icon, link, permission]
		$items[] = ['eSHOP Panel', 'fa-desktop', '?p=eshop/dashboard', null];
	}


	public static function hook_boot_completed()
	{
		// Exécuté après que tout soit initialisé. Juste après le rooting
	}


	public static function hook_user_created($user)
	{
		// Exécuté lorsqu'un utilisateur est créé
	}
		

	public static function hook_user_logged_in($user)
	{
		// Exécuté lorsqu'un utilisateur est connecté.
	}


	public static function hook_user_logged_out($user)
	{
		// Exécuté lorsqu'un utilisateur se déconnect
	}
		

	public static function hook_user_updated($user, $oldvalues)
	{
		// Exécuté lorsqu'un utilisateur est modifié
	}


	public static function hook_user_deleted()
	{
		// Exécuté lorsqu'un utilisateur est supprimé
	}


	public static function hook_page_display(&$page)
	{
		// Exécuté avant d'afficher une page, la page est passée byref et peut être modifiée
	}


	public static function hook_page_updated($page)
	{
		// Exécuté lorsqu'une page est mis à jour dans le panel admin
	}


	public static function hook_page_deleted($page)
	{
		// Exécuté lorsqu'une page est supprimé dans le panel admin
	}


	public static function hook_forum_post_created($post)
	{
		// Exécuté lorsqu'un post sur le forum est créé
	}


	public static function hook_forum_post_updated($post)
	{
		// Exécuté lorsqu'un post sur le forum est mis à jour
	}


	public static function hook_forum_post_deleted($post)
	{
		// Exécuté lorsqu'un post sur le forum est supprimé
	}
		

	public static function hook_forum_topic_created($topic)
	{
		// Exécuté lorsqu'un topic sur le forum est créé
	}


	public static function hook_forum_topic_updated($topic)
	{
		// Exécuté lorsqu'un topic du forum est mis à jour
	}


	public static function hook_forum_topic_deleted($topic)
	{
		// Exécuté lorsqu'un topic du forum est supprimé
	}


	public static function hook_forum_before_posts_loop(&$posts)
	{
		//
	}


	public static function hook_forum_before_topics_loop(&$topics)
	{
		//
	}


	public static function hook_forum_before_forums_loop(&$forums)
	{
		//
	}


	public static function hook_forum_display_post_signature($post)
	{
		//
	}

	public static function Widget()
	{
		//
	}

}

?>