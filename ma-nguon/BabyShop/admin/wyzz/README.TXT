Wyzz WYSIWYG Editor

VERSION
=======

v0.1


INSTALLATION
============

1. Unzip everything to somewhere convenient, maintaining the directory structure.

2. Upload to your website so that wyzz.js is in the same directory as your form.

3. Place the following line in the <head> area of the page containing your form:

   <script language="JavaScript" type="text/javascript" src="wyzz.js"></script>
   
4. After the textarea you want to Wyzzify, place a small script like this:

  Suppose this is your textarea:
  <textarea name="textfield" id="textfield" rows="10" cols="40"></textarea><br />
  
  Then somewhere after it add:
  <script language="javascript1.2">make_wyzz('textfield');</script>
  
  Make sure that the argument of the make_wyzz() function matches the ID of the textarea.
  
5. To change the size of the Wyzz editor window from the default value, , edit the first 
   few lines of wyzz.js  
  

That's it! Eventually there'll be a forum on the site where you can ask any questions ...