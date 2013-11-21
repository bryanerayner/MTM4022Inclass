// JavaScript Document

/****************************************************

	Your instructions...
	
	0. Create a database on your localhost called 'chars', and import the characters.sql file to it.
	
	1. Create a table to hold the data from the form on the page (encrypt the password using MD5)
	2. When the player chooses a character, use jQuery to place the name of that character in the corresponding div (make sure it starts with a name on page load).
	3. When the player enters the rest of the information (do not worry about validation) an clicks, use ajax to enter this information into your table.
	
	4a. If the AJAX call is successful, use some sort of fancy jQuery or CSS animation to hide the form and character picker, and display a success message (ie. welcome to our game!) ... you may add to the HTML to accomplish this, but are not allowed to edit the HTML otherwise.  You may use any jQuery plugin, if you should so desire.
	4b. You will also have to write the short PHP page that sends the SQL call to the database.  You are not getting data back - so if the SQL is successful, simply echo out some success message, and look for that when you check what was returned to your AJAX call (inside the data variable in your success function).  You may send the call to the database however you feel in the PHP, either through the method I taught you or the method your PHP teacher taught you.
	
	5. This is the tricky part.  Once you know the data can be successfully entered into the database, you need to do some AJAX form validation.  On blur, for both the username field and the email field, write an AJAX call (and the corresponding PHP) that checks whether or not the username or the email exists in the database already.  This time you will need to do a select statement, looking for a row where username or email equals whatever the user typed into the form.  If you get something back from the SQL call (not an empty dataset), then you know the information already exists and you should give an error message, and not allow the user to submit the form.  You must make sure data can be entered into the database before you can do step 5!
	
	6. Submit to the edumedia server at imd.edumedia.ca/abcd1234/mtm4022/inclass/inclass.html - you will also need to export your tables, and then import your tables to the edumedia server's database (edumedia.ca/phpMyAdmin), changing the connection information in your PHP files accordingly.
	
****************************************************/

var returnedAjax;



function submit_success(data, textStatus, jqXHR){

}
function submit_error(jqXHR, textStatus, errorThrown){
	
}



$(document).ready(function(){
	
	
	$("#btnSubmit").on("click",function(){
		var userName, pass, email, playName, credit, country, characterType, playForm;

		playForm = $("#playForm")[0];



		userName = $("#userName").val();
		pass = $("#pass").val();
		email = $("#email").val();
		playName = $("#playName").val();
		country = playForm.country.value;
		credit = $("#credit").val();

		characterType = $(".cButton.activated").first().attr("id").replace("c", "");

		var data = {
			userName:userName,
			pass:pass,
			email:email,
			playName:playName,
			country:country,
			credit:credit,
			characterType:characterType
		};

		$.ajax({
			type:"post",
			url:"submit.php",
			datatype: "json",
			data:data,
			success:submit_success,
			error:submit_error
		});


		return false;
	});
	
	
	/*****************************************************************************
		Touch not the javascript beyond this point, grasshopper.
		(You may look at it though)
	*****************************************************************************/
	
	$.ajax({
		type: "get", //or post
		url: "chars.php", //where is this going?
		data: {"name":"Compost Heap"}, //data to send along (as though with a form submission)
		datatype: "xml", //or text, or json, or html - datatype to expect returned
		success: function(data){
			//what to happen if it worked
			$("#cName").html($(data).find("name").text()); //'find' parses XML to look for a particular tag (should also work on HTML)
			$("#cJob").html($(data).find("job").text());	
			$("#cDescription").html($(data).find("description").text());
			$(".power").width(parseInt($(data).find("power").text()) + "%");
			$(".magic").width(parseInt($(data).find("magic").text()) + "%");
			$(".awesome").width(parseInt($(data).find("awesome").text()) + "%");
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert(errorThrown);	
		}
	});
	
	/****************radio clicks!*/
	$("#charRadios .cButton").click(function(event){
		//jquery hasClass: look for a class (even among many)
		if(!($(this).hasClass("activated"))){		
			//as the parent element to find all the buttons, then ask for the index of this particular object
			//jquery parent - gets the parent element
			//jquery find - like querySelectorAll, but in a specific jquery object
			//jquery index - search for the given element among many element, return it's indexed value (starting at 0)
			var index = $(this).parent().find('.cButton').index(this);
			
			//remove a class from the buttons (if any of them have it)
			$(".cButton").removeClass("activated");
			//add the class back to the one we just clicked
			$(this).addClass("activated");
			
			var charName = $(this).data("name");
			$.ajax({
				type: "get", //or post
				url: "chars.php", //where is this going?
				data: {"name":charName}, //data to send along (as though with a form submission)
				datatype: "xml", //or text, or json, or html - datatype to expect returned
				success: function(data){
					//what to happen if it worked
									
					//**********************animation for the character slider...
					//stop any queued animations...
					//$("#picholder").finish();  --stops the animation but completes it (no good for us)
					//gets rid of any animation that hasn't happened yet, so only the next one will happen
					$("#picholder").clearQueue();
					//now use the index to get the margin we want
					//jquery width - finds the current computed width of the element
					var margin = -($("#slider").width() * index) + "px";		
					//use .animate to animate the margin of the object...
					$("#picholder").animate({'margin-left':margin}, 1000, 'swing');
					
					
					//**********************animation for the descriptions...
					
					//jquery call-back functions: after one function has completed, the callback function will run
					//.hide, .show can also be .toggle ...but toggle might break things in this case...
					$("#cInfo1").hide(500, 'swing', function(){
						$("#cName").html("Name: " + $(data).find("name").text());
						$("#cJob").html("Job: " + $(data).find("job").text());
						$(this).show(500, 'swing');	
					});
					
					//fadeOut and fadeIn also have a fadeToggle, but it breaks things here too...
					$("#cDescription").fadeOut(500, 'swing', function(){
						$("#cDescription").html($(data).find("description").text());
						$("#cDescription").fadeIn(500, 'swing');
					});
					
					//**********************animation for the stats...
					//clear any that haven't happened yet
					$("#stats span").clearQueue();
					//now animate the rest
					var power = $(data).find("power").text() + "%";
					$(".power").animate({'width':power}, 500, 'swing');
					var magic = $(data).find("magic").text() + "%";
					$(".magic").animate({'width':magic}, 500, 'swing');
					var awesome = $(data).find("awesome").text() + "%";
					$(".awesome").animate({'width':awesome}, 500, 'swing');
				},
			error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);	
				}
			});
		}
		
	});
});