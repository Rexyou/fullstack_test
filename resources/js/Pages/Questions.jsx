import React, { useState } from 'react'
import { router, useForm, usePage } from '@inertiajs/react'

export default function Questions() {

  const pageData = usePage();
  const otherErrors = pageData.props.errors;

  const { data, setData, get, processing, errors } = useForm({
    total_players: 0
  })

  const handleChange = (e) => {
    const key = e.target.id;
    const value = e.target.value
    setData(key, value);
  }

  const handleSubmit = (e) => {
      e.preventDefault()
      if(data.total_players == 0 || data.total_players < 0){
        alert("Players cannot be 0 or lower than 0");
        return;
      }

      get('/process');
  }

  return (
    <div>
      <form onSubmit={handleSubmit}>
        <label htmlFor="total_players">How many players for this game?</label>
        <br />
        <input type="number" placeholder='How many players for this game' id="total_players" min="1" onChange={handleChange} />
        {errors.total_players && <div style="color:red"><b>{errors.total_players}</b></div>}
        <button type='submit'>Submit</button>
      </form>
      {Object.values(otherErrors).map((error, index) => (
        <span key={index} style="color:red;">{ error }</span>
      ))}
    </div>
  )
}
