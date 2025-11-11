const CheckboxsEvent = {
    events: {},
    listen(event, callback) {
        this.events[event] = callback;
    },
    emit(event, ...args) {
        if (Object(this.events).hasOwnProperty(event)) {
            this.events[event](...args);
        }
    }
};

export default CheckboxsEvent;
