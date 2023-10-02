export default function MethodsButtons({ onClickButton, method, disabled }) {
    const lowerMethod = method.toLowerCase();
    switch (lowerMethod) {
        case "get":
            return (
                <button
                    className="inline-flex justify-center text-md items-center px-10 py-3 bg-purple-600 border border-transparent rounded-3xl font-semibold text-white uppercase tracking-widest hover:bg-purple-500 active:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full text-center"
                    onClick={onClickButton}
                    disabled={disabled}
                >
                    GET
                </button>
            );
        case "post":
            return (
                <button
                    className="inline-flex justify-center text-md items-center px-10 py-3 bg-sky-600 border border-transparent rounded-3xl font-semibold text-white uppercase tracking-widest hover:bg-sky-500 active:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full text-center"
                    onClick={onClickButton}
                    disabled={disabled}
                >
                    POST
                </button>
            );
        case "put":
            return (
                <button
                    className="inline-flex justify-center text-md items-center px-10 py-3 bg-indigo-600 border border-transparent rounded-3xl font-semibold text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full text-center"
                    onClick={onClickButton}
                    disabled={disabled}
                >
                    PUT
                </button>
            );
        case "patch":
            return (
                <button
                    className="inline-flex justify-center text-md items-center px-10 py-3 bg-amber-600 border border-transparent rounded-3xl font-semibold text-white uppercase tracking-widest hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full text-center"
                    onClick={onClickButton}
                    disabled={disabled}
                >
                    PATCH
                </button>
            );
        case "delete":
            return (
                <button
                    className="inline-flex justify-center text-md items-center px-10 py-3 bg-red-600 border border-transparent rounded-3xl font-semibold text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full text-center"
                    onClick={onClickButton}
                    disabled={disabled}
                >
                    DELETE
                </button>
            );
        default:
            return (
                <button
                    className="text-white bg-purple-500 px-10 py-3 rounded-3xl w-full"
                    onClick={onClickButton}
                    disabled={disabled}
                >
                    GET
                </button>
            );
    }
}
