class TweetyForm {
    constructor(data) {
        this.originalData = JSON.parse(JSON.stringify(data));

        Object.assign(this, data);

        this.errors = {};

        this.submitted = false;
    }

    data() {
        let data = {};
        for (let attributes in this.originalData) {
            data[attributes] = this[attributes];
        }

        return data;
    }

    post(endpoint) {
        this.submit(endpoint);
    }

    patch(endpoint) {
        this.submit(endpoint, "patch");
    }

    delete(endpoint) {
        this.submit(endpoint, "delete");
    }

    submit(endpoint, requestType = "post") {
        return axios[requestType](endpoint, this.data())
            .catch(this.onFail.bind(this))
            .then(this.onSuccess.bind(this));
    }

    onSuccess(response) {
        this.submitted = true;
        this.errors = {};
        return response;
    }

    onFail(error) {
        this.errors = error.response.data.errors;
        this.submitted = false;
        throw error;
    }

    reset() {
        Object.assign(this, this.originalData);
    }
}

export default TweetyForm;
