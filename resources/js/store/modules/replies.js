export const namespaced = true;

export const state = {
    replies: [],
    repliesTotal: 0,
    reply: {}
};

export const mutations = {
    ADD_REPLY(state, reply) {
        state.replies.push(reply);
    },
    SET_REPLIES(state, replies) {
        state.replies = replies;
    },
    SET_REPLIES_TOTAL(state, repliesTotal) {
        state.repliesTotal = repliesTotal;
    },
    SET_REPLY(state, reply) {
        state.reply = reply;
    }
};

export const actions = {
    addReply({ commit }, reply) {
        commit("SET_REPLY", reply);
    },
    fetchREPLIES({ commit }, page) {
        EventService.getEvents(perPage, page)
            .then(response => {
                commit(
                    "SET_EVENTS_TOTAL",
                    parseInt(response.headers["x-total-count"])
                );
                commit("SET_EVENTS", response.data);
            })
            .catch(error => {
                const notification = {
                    type: "error",
                    message:
                        "There was a problem fetching events: " + error.message
                };
                dispatch("notification/add", notification, { root: true });
            });
    },
    fetchEvent({ commit, getters, dispatch }, id) {
        var event = getters.getEventById(id);

        if (event) {
            commit("SET_EVENT", event);
        } else {
            EventService.getEvent(id)
                .then(response => {
                    commit("SET_EVENT", response.data);
                })
                .catch(error => {
                    const notification = {
                        type: "error",
                        message:
                            "There was a problem fetching event: " +
                            error.message
                    };
                    dispatch("notification/add", notification, { root: true });
                });
        }
    }
};
export const getters = {
    getEventById: state => id => {
        return state.events.find(event => event.id === id);
    }
};
