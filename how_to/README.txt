Minimum Requirement : 
	Skills with Bootstrap 4.4.1
	Skills with HTML / CSS / PhP

 - There is the default skeleton of the json file.
{
    "name": "demo",
    "description": "Blah blah blah blah",
    "version": "1.0.0",
    "authors": ["Evo-CMS <no@e-mail> (https://php.net)"],
    "exports": ["plugin"],

    "homepage": "http://blog.evolution-network.ca/download",
    "manifest": "https://github.com/ducalex/evo-cms/tree/master/modules/demo/module.json",
    "download": "",
    "changelog": [{ "version": "0.9.0", "date": "2018-01-01", "changes": "Blah blah blah" }],

    "settings": {
		"a": {"type": "color", "label": "Couleur", "default": "#dddddd"},
		"b": {"type": "image", "label": "Image"},
		"c": {"type": "text",  "label": "say what?"},
		"d": {"type": "enum",  "label": "page", "choices": [1,2,3]},
		"e": {"type": "bool",  "label": "aaa"}
    },

    "permissions": {"test123": "Test permission 123"}
}


 - If you want to test you plugin, put you folder into «/root/module/»
 - Go to admin panel > modules
 - Click on ACTIVATE to your plugin

We know there is a lack of translation into the English language.
We are working on this concern.

Enjoy it !

If you have any questions, you can visit our website : http://blog.evolution-network.ca/ 
And if you want to ask some questions to the community, you can use our forum : http://blog.evolution-network.ca/forums
Feel free to getting contact with us.

Best Regards.
Coolternet, Administrator