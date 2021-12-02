//cache form input to browser's localstorage

const formId = "myForm";
const url = location.href;
const formIdentifier = `${url} ${formId}`;

let form = document.querySelector(`#${formId}`);
let formElements = form.elements;

const getFormData = () => {
	let data = { [formIdentifier]: {} };
	for (const element of formElements){
		if(element.name.length > 0){
			data[formIdentifier][element.name] = element.value;
		}
	}

	return data;
};

window.onbeforeunload = function(){
	data = getFormData();
	localStorage.setItem(formIdentifier, JSON.stringify(data[formIdentifier]));
}