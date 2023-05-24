import styles from './index.less';
import { Link } from 'umi';

export default function IndexPage() {
  return (
    <div>
      <h1 className={styles.title}>useres</h1>
        <Link to="/">users</Link>
    </div>
  );
}
