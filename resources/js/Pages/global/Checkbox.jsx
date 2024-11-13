import  { useState } from 'react';

export default function Checkbox({completed, onToggle}) {


    return (
        <div
            className="border border-white w-4 h-4"
            onClick={onToggle}
        >
            <div className={completed ? "bg-white" : ""}>
                {completed && <img src="/images/check.webp" alt="Checkmark" />}
            </div>
        </div>
    );
}
