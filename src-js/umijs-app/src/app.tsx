import {history} from 'umi';

export function render(oldRender) {
    fetch('/api/auth').then(auth => {
        if (auth.isLogin) {
            history.push('/index');
            oldRender()
        } else {
            history.push('/login');
            oldRender()
        }
    });
}