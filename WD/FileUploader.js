var FileUploader = Class.create({

    ID_KEY         : 'APC_UPLOAD_PROGRESS',
    statusUrl      : 'status.php',
    pollDelay      : 0.5,

    form           : null, // HTML form element
    status         : null, // element where the upload status is displayed
    statusTemplate : null, // Prototype Template object
    idElement      : null, // element that holds the APC upload ID
    iframe         : null, // iframe we create that form will submit to

    initialize : function(form, status)
    {
        // initialize the form and observe the submit element
        this.form = $(form);
        this.form.observe('submit', this._onFormSubmit.bindAsEventListener(this));

        // create a hidden iframe
        this.iframe = new Element('iframe', { name : '_upload_frame' }).hide();

        // make the form submit to the hidden iframe
        this.form.appendChild(this.iframe);
        this.form.target = this.iframe.name;

        // initialize the APC ID element so we can write a value to it later
        this.idElement = this.form.getInputs(null, this.ID_KEY)[0];

        // initialize the status container
        this.status = $(status);

        // create a template based on the HTML inside the status container
        this.statusTemplate = new Template(this.status.innerHTML);

        // clear the status template
        this.status.update();
    },

    generateId : function()
    {
        var now = new Date();
        return now.getTime();
    },

    delay : function(seconds)
    {
        var ms   = seconds * 1000;
        var then = new Date().getTime();
        var now  = then;

        while ((now - then) < ms)
            now = new Date().getTime();
    },

    _onFormSubmit : function(e)
    {
        var id = this.generateId();

        this.idElement.value = id;
        this._monitorUpload(id);
    },

    _monitorUpload : function(id)
    {
        var options = {
            parameters : 'id=' + id,
            onSuccess  : this._onMonitorSuccess.bind(this)
        };

        new Ajax.Request(this.statusUrl, options);
    },

    _onMonitorSuccess : function(transport)
    {
        var json = transport.responseJSON;

        this.status.show();
        this.status.update(this.statusTemplate.evaluate(json));

        if (!json.finished) {
            this.delay(this.pollDelay);
            this._monitorUpload(json.id);
        }
    }
});