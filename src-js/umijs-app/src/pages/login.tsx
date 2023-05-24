import styles from './index.less';
import { Link } from 'umi';

export default function LoginPage() {
  return (
    <div>
      <h1 className={styles.title}>Page index</h1>
        <Link to="/users">Go to list page</Link>
    </div>
  );
}
