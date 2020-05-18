function Logger(defaultAuthor = "UNKNOW MODULE", template = "[#author]: #msg") {

    function format(author, msg) {
        let st1 = template.replace('#author', author);
        let st2 = st1.replace('#msg', msg);

        return st2
    }

    function clear(){
        console.clear();
    }

    function log(msg, author = defaultAuthor) {
        console.log(format(author, msg))
    }

    return {
        log,
        clear
    };
}

module.exports = Logger;