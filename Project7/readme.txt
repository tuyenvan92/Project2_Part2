
My topic is shop glasses, Eyeonic Glasses. I have created a website that selling glasses,
base on this https://www.glassesusa.com/ website.

To use the site, at first you'll wish to install the database to your local php myadmin by the code in the file eyeonic.sql.

*I will start with the path to manager our website, the admin path. There are 2 role for admin - owner and normaly admin,
storaged in tbl_users table, with user type are 1 and 2. The admin have the rights to add, repair or delete products and 
customers' orders. The owner have it too, and one more impotant rights is adding or deleting admins.Firstly, you can login to
http://localhost/eProject/admin with email owner@mail.neot and password '123456789' as an owner and authenticate our
manage system.
After that, I have the client-site with functions allow customers to find and order their favourite glasses essily.
In Homepage, I have a list of some products to essy select. If you want more, or see the products filted by Brands
(like Ray-ban) or type (like sunglasses), you can select it in the Navbar. Or search by the search form. If a product
is selected, the site will redirects to the product page. In here, you can see the more detail information of the product, 
and also add it to Cart if you like (you have to Login/Signup first  to do that). After add to card, you cand order list products
in Cart in the order Page.
Some of out function are not completed or in bug, I wish we have more time to complete and fix them. 


*There are the request list in your topic we have completed: 
	1.Logo
	2.The site should display a menu which will contain the options for brief
	  introduction about the various frames and lenses available, location of the
	  shop and any other information if required.
	3. The information should be categorized according to the brand names of the
	  products like if a User wants to see only “Ray-Ban” products or any other
	  companies products then he/she can click on a Link/button/menu etc and can
	  see only that Brand products.
	4.Another category option for “Contact Lenses”, “SunGlasses” etc. should be
	  created and accordingly the products should be listed.(The data of Contact Lense are not available yet)
	5.When a user selects any particular brand, a list of products for that brand will
	 be displayed
	6.A brief summary of features of individual products should be displayed on the
	  Web Page along with the product but detailed Features should be stored in
	  Individual Word documents which can be downloaded or viewed by the User
	  who wishes to see the same.(in Product page)
	7.The user should also be able to compare the various products of different as
	  well as similar brands.(example: in sunglasses page, hover on a product and you will see compare button. Just click it!)
	8.There should be a “Contact Us” page which will have the Address of the
	  Company which is as follows and the mail address which when clicked will
	  invoke the local mail client from where they can send an email. Address of the
	  Company should be displayed using GeoLocation API (eg. GoogleMaps).(ContatcUs page is located in top-left : 'Contact Us - All day.Every Day. 24-7')
