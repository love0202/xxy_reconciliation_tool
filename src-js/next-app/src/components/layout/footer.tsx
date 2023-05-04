import {Inter} from 'next/font/google'

const inter = Inter({subsets: ['latin']})

export default function Footer() {
    return (
        <footer className="bg-info">
            <div className="container">
                <div className="d-flex justify-content-between">
                    <div>底部导航1</div>
                    <div>底部导航2</div>
                    <div>底部导航3</div>
                    <div>底部导航4</div>
                </div>
                <div className="d-flex justify-content-between">
                    <div>底部导航1</div>
                    <div>底部导航2</div>
                    <div>底部导航3</div>
                    <div>底部导航4</div>
                </div>
                <div className="d-flex justify-content-between">
                    <div>底部导航1</div>
                    <div>底部导航2</div>
                    <div>底部导航3</div>
                    <div>底部导航4</div>
                </div>
                <div className="text-center">
                    <p>@所有权next-app</p>
                </div>
            </div>
        </footer>
    )
}
