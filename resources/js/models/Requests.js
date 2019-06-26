class Requests {

    static index(url, then, error) {
        axios
            .get(url)
            .then(then)
            .catch(error)
    }

    static show(url, model, then, error) {
        axios
            .get(`${url}/${model}`)
            .then(then)
            .catch(error)
    }

    static store(url, data, then, error) {
        axios
            .post(url, data)
            .then(then)
            .catch(error)
    }

    static update(url, model, data, then, error) {
        axios
            .put(`${url}/${model}`, data)
            .then(then)
            .catch(error)
    }

    static destroy(url, model, then, error) {
        axios
            .delete(`${url}/${model}`)
            .then(then)
            .catch(error)
    }
}

export default Requests;