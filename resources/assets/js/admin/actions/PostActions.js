import { getting, putting, posting, setCookie } from "../../helpers";
import routes from '../routes';

export const increment = () => dispatch => {
    dispatch({ type: 'INCREMENT' });
};

export const setPost = (id, attributes) => {
    return (dispatch) => {
        dispatch({ type: 'SET-POST', id, attributes })
    }
}

export const updatePost = (post) => {
    return (dispatch) => {
        putting(routes('api.posts.update',[post.id]), post.attributes)
            .then(response => dispatch({
                type: 'UPDATE-POST',
                payload: response.data
            }))
            .catch( error => { console.log(error.response) } );
    }
}

export const getPosts = () => {
    return (dispatch) => {
        getting(routes('api.posts.index'))
            .then(response => dispatch({
                type: 'GET-POSTS',
                payload: response.data
            }))
            .catch( error => { console.log(error.response) } );
    }
}